import React, { useState, useCallback, useEffect, useRef } from 'react';
import { Link } from 'react-router-dom';
import { toast } from 'sonner';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { CustomKeypad } from '@/components/ui/CustomKeypad';
import { cn } from '@/lib/utils';
import { sendWelcomeEmailPreview, sendOtpEmailPreview, generateOtp } from '@/lib/email-preview';
import {
  CheckCircle2, ChevronRight, Eye, EyeOff, Loader2,
  Phone, User, Lock, Shield, RefreshCw, ArrowLeft,
  Gift, MapPin, AlertTriangle, UserCheck, XCircle
} from 'lucide-react';

type Step = 'info' | 'otp' | 'passcode' | 'pin';

const STEPS: { key: Step; label: string }[] = [
  { key: 'info', label: 'Account Information' },
  { key: 'otp', label: 'Verify OTP' },
  { key: 'passcode', label: 'Create Passcode' },
  { key: 'pin', label: 'Create PIN' },
];

interface FormData {
  firstname: string;
  other_names: string;
  phone: string;
  username: string;
  email: string;
  password: string;
  referral_code: string;
  portal: 'User Portal' | 'Employment Portal' | 'Marketer Portal';
}

interface CodePopup {
  type: 'referral' | 'promo' | 'ended' | 'invalid';
  refereeName?: string;
  eventName?: string;
  eventLocation?: string;
}

export default function RegisterPage() {
  const inputRef = useRef<HTMLInputElement>(null);
  
  const [step, setStep] = useState<Step>(() => {
    const saved = localStorage.getItem('onboarding_step');
    return (saved === 'otp' || saved === 'passcode' || saved === 'pin') ? saved : 'info';
  });
  
  const [verificationToken, setVerificationToken] = useState<string>(() => {
    return localStorage.getItem('verification_token') || '';
  });

  const [loading, setLoading] = useState(false);
  const [showPassword, setShowPassword] = useState(false);
  const [codePopup, setCodePopup] = useState<CodePopup | null>(null);
  const [codeChecking, setCodeChecking] = useState(false);
  const [promoEventId, setPromoEventId] = useState<string | null>(null);

  const [form, setForm] = useState<FormData>({
    firstname: '', other_names: '', phone: '', username: '',
    email: '', password: '', referral_code: '', portal: 'User Portal'
  });
  const handlePhoneChange = (val: string) => {
    let cleaned = val.replace(/\D/g, ''); // Remove non-numeric
    if (cleaned.startsWith('0')) cleaned = cleaned.substring(1); // No leading zero
    if (cleaned.length <= 10) updateForm('phone', cleaned);
  };
  const [otp, setOtp] = useState('');
  const [otpTimer, setOtpTimer] = useState(0);
  const [passcode, setPasscode] = useState('');
  const [passcodeConfirm, setPasscodeConfirm] = useState('');
  const [passcodeStep, setPasscodeStep] = useState<'create' | 'confirm'>('create');
  const [pin, setPin] = useState('');
  const [pinConfirm, setPinConfirm] = useState('');
  const [pinStep, setPinStep] = useState<'create' | 'confirm'>('create');

  useEffect(() => {
    localStorage.setItem('onboarding_step', step);
  }, [step]);
  useEffect(() => {
  const savedExpiry = localStorage.getItem('otp_expiry');
  if (savedExpiry) {
    const remaining = Math.max(0, Math.round((parseInt(savedExpiry) - Date.now()) / 1000));
    if (remaining > 0) {
      setOtpTimer(remaining);
      intervalRef.current = setInterval(() => {
        const timeRemaining = Math.max(0, Math.round((parseInt(localStorage.getItem('otp_expiry') || '0') - Date.now()) / 1000));
        setOtpTimer(timeRemaining);
        if (timeRemaining <= 0) {
          if (intervalRef.current) clearInterval(intervalRef.current);
          localStorage.removeItem('otp_expiry');
        }
      }, 1000);
    } else {
      localStorage.removeItem('otp_expiry');
    }
  }
  
  // Cleanup interval on unmount
  return () => {
    if (intervalRef.current) clearInterval(intervalRef.current);
  };
}, []);
  useEffect(() => {
    if (verificationToken) {
      localStorage.setItem('verification_token', verificationToken);
    } else {
      localStorage.removeItem('verification_token');
    }
  }, [verificationToken]);

  const updateForm = (field: keyof FormData, value: string) =>
    setForm(f => ({ ...f, [field]: value }));

  const handleClearCode = useCallback(() => {
    updateForm('referral_code', '');
    setCodePopup(null);
    setPromoEventId(null);
  }, []);

  const handleEditCode = useCallback(() => {
    setCodePopup(null);
    inputRef.current?.focus();
  }, []);

  const capitalizeWords = (str: string) => {
    return str
      .split(' ')
      .map(word => word.charAt(0).toUpperCase() + word.slice(1))
      .join(' ');
  };

  const handleResetRegistration = () => {
    localStorage.removeItem('onboarding_step');
    localStorage.removeItem('verification_token');
    localStorage.removeItem('token');
    window.location.reload();
  };

  const stepIndex = STEPS.findIndex(s => s.key === step);
  const cleanInput = (val: string) => val.replace(/[<>'"/;`]/g, '').trim();
  
  const validateCode = useCallback(async (code: string) => {
    const sanitizedCode = cleanInput(code);
    if (!sanitizedCode) return;
    setCodeChecking(true);
    await new Promise((resolve) => setTimeout(resolve, 600));
    setCodePopup({ type: 'referral', refereeName: 'Demo Referrer' });
    setPromoEventId(null);
    setCodeChecking(false);
  }, []);

  const handleInfoSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (form.phone.length < 10) {
      toast.error('Please enter a valid phone number (min 10 digits).');
      return;
    }
    const sanitizedUsername = form.username.toLowerCase().replace(/[^a-z0-9_]/g, '');
    const sanitizedPhone = form.phone.replace(/[^0-9+]/g, '');
    const passwordStrongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;

    if (!form.firstname.trim() || !sanitizedPhone || !sanitizedUsername || !form.password || !form.email.trim()) {
      toast.error('Please fill in all required fields, including a valid email address.');
      return;
    }
    if (!passwordStrongRegex.test(form.password)) {
      toast.error('Password must be 8+ chars with uppercase, lowercase, number, and symbol.');
      return;
    }

    setLoading(true);
    await new Promise((resolve) => setTimeout(resolve, 800));
    const code = generateOtp();
    localStorage.setItem('imtechpay_otp', code);
    sendOtpEmailPreview(form.email, code);
    setLoading(false);
    startOtpTimer();
    setStep('otp');
    toast.success(`A verification code has been prepared for ${form.email}. Please send the email and enter the OTP.`);
  };
const intervalRef = useRef<ReturnType<typeof setInterval> | null>(null);
  const startOtpTimer = useCallback(() => {
  // Clear any existing timer before starting a new one
  if (intervalRef.current) clearInterval(intervalRef.current);
  
  const expiry = Date.now() + 120000;
  localStorage.setItem('otp_expiry', expiry.toString());
  setOtpTimer(120);

  intervalRef.current = setInterval(() => {
    const savedExpiry = localStorage.getItem('otp_expiry');
    if (!savedExpiry) {
      if (intervalRef.current) clearInterval(intervalRef.current);
      return;
    }

    const remaining = Math.max(0, Math.round((parseInt(savedExpiry) - Date.now()) / 1000));
    setOtpTimer(remaining);
    
    if (remaining <= 0) {
      if (intervalRef.current) clearInterval(intervalRef.current);
      localStorage.removeItem('otp_expiry');
    }
  }, 1000);
}, []);

  const handleOtpSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (otp.length < 6) { toast.error('Enter a valid 6-digit verification code'); return; }

    const storedOtp = localStorage.getItem('imtechpay_otp');
    if (otp !== storedOtp) {
      toast.error('Invalid OTP. Please check the code sent to your email.');
      return;
    }

    setLoading(true);
    await new Promise((resolve) => setTimeout(resolve, 600));
    setLoading(false);
    setVerificationToken('');
    localStorage.removeItem('imtechpay_otp');
    setStep('passcode');
    toast.success('Email verified. Proceeding to passcode setup.');
  };

  const resendOtp = async () => {
    setLoading(true);
    await new Promise((resolve) => setTimeout(resolve, 600));
    const code = generateOtp();
    localStorage.setItem('imtechpay_otp', code);
    sendOtpEmailPreview(form.email, code);
    startOtpTimer();
    toast.success(`A fresh OTP has been prepared for ${form.email}.`);
    setLoading(false);
  };

  const handlePasscode = () => {
    if (passcodeStep === 'create') {
      if (passcode.length < 4) { toast.error('Passcode must be at least 4 digits'); return; }
      setPasscodeStep('confirm');
    } else {
      if (passcode !== passcodeConfirm) {
        toast.error('Passcodes do not match');
        setPasscodeConfirm('');
        return;
      }
      setStep('pin');
    }
  };

  const handlePin = async () => {
    if (pinStep === 'create') {
      if (pin.length !== 4) { toast.error('PIN must be exactly 4 digits'); return; }
      setPinStep('confirm');
    } else {
      if (pin !== pinConfirm) {
        toast.error('PINs do not match');
        setPinConfirm('');
        return;
      }
      setLoading(true);
      await new Promise((resolve) => setTimeout(resolve, 800));
      localStorage.removeItem('onboarding_step');
      sendWelcomeEmailPreview({
        email: form.email,
        fullName: `${form.firstname} ${form.other_names}`.trim(),
        portal: form.portal,
        phone: form.phone,
        username: form.username,
        referralCode: form.referral_code,
      });
      toast.success('Account setup complete. A welcome email has been prepared for you.');
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen bg-background flex">
      {/* Brand Left Panel (Desktop) */}
      <div className="hidden lg:flex lg:w-[45%] xl:w-[40%] relative flex-col justify-between p-10 overflow-hidden bg-card border-r border-border">
        <div className="absolute inset-0 pointer-events-none">
          <div className="absolute top-0 right-0 w-80 h-80 rounded-full bg-primary/20 blur-[100px]" />
          <div className="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-primary/10 blur-[80px]" />
        </div>

        <div className="relative z-10">
          <Link to="/" className="inline-flex items-center gap-1.5 text-muted-foreground hover:text-foreground transition-colors text-sm mb-12">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </Link>
          <Button 
  variant="ghost" 
  onClick={handleResetRegistration} 
  className="text-muted-foreground hover:text-destructive"
>
  <RefreshCw className="mr-2 h-4 w-4" />
  Register a different account
</Button>
          <div className="flex items-center gap-3 mb-2">
            <img src="./logo.png" alt="IMTechPay" className="w-12 h-12 object-contain" />
            <span className="font-bold text-xl font-[Manrope]">IMTechPay</span>
          </div>
          <p className="text-muted-foreground text-sm">Join 200,000+ Nigerians on the premier VTU platform</p>
        </div>

        <div className="relative z-10 space-y-4">
          <h2 className="text-2xl font-bold font-[Manrope] leading-tight text-balance">
            Your Account,<br />
            <span className="text-primary">Your Money, Your Platform</span>
          </h2>
          <div className="space-y-3 mt-4">
            {[
              { icon: CheckCircle2, text: 'Free to create — no hidden charges' },
              { icon: CheckCircle2, text: 'Unlock higher limits as you grow' },
              { icon: CheckCircle2, text: 'White-label your own VTU business (Tier 3)' },
            ].map(({ icon: Icon, text }) => (
              <div key={text} className="flex items-center gap-3 text-sm text-muted-foreground">
                <Icon className="w-4 h-4 text-primary shrink-0" />
                {text}
              </div>
            ))}
          </div>
        </div>

        <div className="relative z-10 flex items-center gap-2 text-xs text-muted-foreground border-t border-border pt-5">
          <Shield className="w-3.5 h-3.5 text-primary" />
          <span>SSL Secured · Powered by CBN-licensed Payment Partners · Secure Payment Gateways</span>
        </div>
      </div>

      {/* Form Right Panel */}
      <div className="flex-1 flex flex-col items-center justify-center p-5 md:p-10 overflow-y-auto">
        <div className="w-full max-w-md mb-4 lg:hidden">
          <Link to="/" className="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-primary transition-colors">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </Link>
        </div>

        <div className="w-full max-w-md">
          <div className="flex items-center gap-2.5 mb-6 lg:hidden">
            <img src="https://miaoda-conversation-file.s3cdn.medo.dev/user-d8no6jsrey9s/app-d8noh2mwr30h/20260724/logo.png" alt="IMTechPay" className="w-10 h-10 object-contain" />
            <span className="font-bold text-base font-[Manrope]">IMTechPay</span>
          </div>

          {/* Stepper tracking */}
          <div className="flex items-center mb-7 gap-1.5">
            {STEPS.map((s, i) => (
              <React.Fragment key={s.key}>
                <div className={cn(
                  'w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold transition-all shrink-0',
                  i < stepIndex ? 'bg-primary text-primary-foreground' :
                  i === stepIndex ? 'bg-primary/20 text-primary border-2 border-primary' :
                  'bg-muted text-muted-foreground'
                )}>
                  {i < stepIndex ? <CheckCircle2 className="w-3.5 h-3.5" /> : i + 1}
                </div>
                {i < STEPS.length - 1 && (
                  <div className={cn('flex-1 h-0.5', i < stepIndex ? 'bg-primary' : 'bg-border')} />
                )}
              </React.Fragment>
            ))}
          </div>

          <div className="mb-5">
            <h1 className="text-2xl font-extrabold text-foreground font-[Manrope]">
              {step === 'info' && 'Create Your Account'}
              {step === 'otp' && 'Verify Your Number'}
              {step === 'passcode' && 'Set Your Passcode'}
              {step === 'pin' && 'Set Your Transaction PIN'}
            </h1>
            <p className="text-muted-foreground text-sm mt-1">{STEPS[stepIndex].label} — Step {stepIndex + 1} of {STEPS.length}</p>
          </div>

          {/* Step 1: Info Form */}
          {step === 'info' && (
            <form onSubmit={handleInfoSubmit} className="space-y-4">
              <div className="grid grid-cols-2 gap-3">
                <div className="space-y-1.5">
                  <Label htmlFor="firstname" className="text-xs font-medium">First Name *</Label>
                  <Input id="firstname" placeholder="John" value={form.firstname}
                    onChange={e => updateForm('firstname', capitalizeWords(e.target.value))}
                    className="h-11 text-sm bg-muted/40 border-border/60 focus:bg-background" required />
                </div>
                <div className="space-y-1.5">
                  <Label htmlFor="other_names" className="text-xs font-medium">Other Names</Label>
                  <Input id="other_names" placeholder="Doe" value={form.other_names}
                    onChange={e => updateForm('other_names', capitalizeWords(e.target.value))}
                    className="h-11 text-sm bg-muted/40 border-border/60 focus:bg-background" />
                </div>
              </div>
              <div className="space-y-1.5">
                <Label htmlFor="phone" className="text-xs font-medium">Phone Number *</Label>
                <div className="relative flex items-center">
                  <div className="absolute left-3 text-sm text-muted-foreground">+234</div>
                  <Input 
                        id="phone" 
                        type="tel"
                        placeholder="8012345678" 
                        value={form.phone}
                        onChange={(e) => handlePhoneChange(e.target.value)}
                        className={cn(
                          "h-11 text-sm pl-16 bg-muted/40 border-border/60 focus:bg-background",
                          form.phone.length > 0 && form.phone.length < 10 && "border-destructive focus-visible:ring-destructive"
                        )} 
                        required 
                      />
                </div>
                {form.phone.length > 0 && form.phone.length < 10 && (
                    <p className="text-[10px] text-destructive mt-1">
                      Enter the remaining 10 digits (e.g., 8012345678)
                    </p>
                  )}
              </div>
              <div className="space-y-1.5">
                <Label htmlFor="username" className="text-xs font-medium">Username *</Label>
                <div className="relative">
                  <User className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                  <Input id="username" placeholder="johndoe" value={form.username}
                    onChange={e => updateForm('username', e.target.value.toLowerCase().replace(/[^a-z0-9_]/g, ''))}
                    className="h-11 text-sm pl-9 bg-muted/40 border-border/60 focus:bg-background" required />
                </div>
              </div>
              <div className="space-y-1.5">
                  <Label htmlFor="email" className="text-xs font-medium">
                    Email Address <span className="text-destructive">*</span>
                  </Label>
                  <Input 
                    id="email" 
                    type="email" 
                    placeholder="john@example.com" 
                    value={form.email}
                    onChange={e => updateForm('email', e.target.value)}
                    className="h-11 text-sm bg-muted/40 border-border/60 focus:bg-background" 
                    required
                  />
                </div>
              <div className="space-y-1.5">
                <Label htmlFor="password" className="text-xs font-medium">Password *</Label>
                <div className="relative">
                  <Lock className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                  <Input id="password" type={showPassword ? 'text' : 'password'} placeholder="Min. 8 characters (mixed alphanumeric)"
                    value={form.password} onChange={e => updateForm('password', e.target.value)}
                    className="h-11 text-sm pl-9 pr-10 bg-muted/40 border-border/60 focus:bg-background" required />
                  <button type="button" onClick={() => setShowPassword(v => !v)}
                    className="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground transition-colors">
                    {showPassword ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
                  </button>
                </div>
              </div>
              <div className="space-y-1.5">
                <Label htmlFor="referral" className="text-xs font-medium">Referral / Promo Code <span className="text-muted-foreground">(Optional)</span></Label>
                <div className="relative flex gap-2">
                  <Input id="referral" placeholder="Enter code" value={form.referral_code}
                    onChange={e => { updateForm('referral_code', e.target.value); setCodePopup(null); setPromoEventId(null); }}
                    className="h-11 text-sm bg-muted/40 border-border/60 focus:bg-background flex-1" />
                  <Button type="button" variant="outline" size="sm" className="h-11 px-3 shrink-0"
                    disabled={!form.referral_code.trim() || codeChecking}
                    onClick={() => validateCode(form.referral_code)}>
                    {codeChecking ? <Loader2 className="w-3.5 h-3.5 animate-spin" /> : 'Check'}
                  </Button>
                </div>
                {codePopup && codePopup.type !== 'invalid' && (
                  <div className={`flex items-center gap-2 p-2 rounded-md text-xs border ${
                    codePopup.type === 'referral' ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-500' :
                    codePopup.type === 'promo' ? 'bg-primary/10 border-primary/30 text-primary' :
                    'bg-destructive/10 border-destructive/30 text-destructive'
                  }`}>
                    {codePopup.type === 'referral' && <><UserCheck className="w-3.5 h-3.5 shrink-0" /> Referral from <strong>{codePopup.refereeName}</strong></>}
                    {codePopup.type === 'promo' && <><Gift className="w-3.5 h-3.5 shrink-0" /> <strong>{codePopup.eventName}</strong> — <MapPin className="w-3 h-3 inline mx-0.5" />{codePopup.eventLocation}</>}
                    {codePopup.type === 'ended' && <><XCircle className="w-3.5 h-3.5 shrink-0" /> Promo &quot;{codePopup.eventName}&quot; has ended</>}
                  </div>
                )}
                {/* Fixed Bottom-Half Dropdown Overlay for Invalid Codes */}
{codePopup?.type === 'invalid' && (
  <div className="fixed inset-x-0 bottom-0 top-1/2 z-[100] animate-in slide-in-from-bottom duration-300">
    {/* Dark Backdrop */}
    <div className="absolute inset-0 bg-background/80 backdrop-blur-sm" onClick={handleClearCode} />
    
    {/* The Sheet */}
    <div className="absolute inset-x-0 bottom-0 h-full bg-background border-t border-border p-6 shadow-2xl flex flex-col items-center justify-center text-center">
      <div className="w-16 h-16 rounded-full bg-destructive/10 flex items-center justify-center mb-6">
        <AlertTriangle className="w-8 h-8 text-destructive" />
      </div>
      
      <h3 className="text-xl font-bold mb-2">Code Not Recognized</h3>
      <p className="text-muted-foreground text-sm mb-8 max-w-xs">
        The referral or promo code entered doesn't match any active events or users in our system.
      </p>

      <div className="flex flex-col w-full max-w-xs gap-3">
        <Button onClick={handleEditCode} className="w-full h-12">
          Try a Different Code
        </Button>
        <Button variant="ghost" onClick={handleClearCode} className="w-full h-12 text-muted-foreground">
          Clear and Continue Anyway
        </Button>
      </div>
    </div>
  </div>
)}
              </div>
              <Button type="submit" className="w-full h-11 font-semibold" disabled={loading}>
                {loading ? <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}
                Continue <ChevronRight className="w-4 h-4 ml-1" />
              </Button>
            </form>
          )}

          {/* Step 2: OTP Entry */}
          {step === 'otp' && (
            <form onSubmit={handleOtpSubmit} className="space-y-5">
              <div className="bg-muted/30 border border-border rounded-xl p-4 text-center">
                <div className="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-2">
                  <Phone className="w-5 h-5 text-primary" />
                </div>
                <p className="text-sm text-muted-foreground">A verification code has been prepared for {form.email}. Send the email and enter the OTP below.</p>
              </div>
              <div className="space-y-1.5">
                <Label htmlFor="otp" className="text-xs font-medium">Enter 6-Digit OTP</Label>
                <Input id="otp" placeholder="••••••" value={otp}
                  onChange={e => setOtp(e.target.value.replace(/\D/g, '').slice(0, 6))}
                  className="h-12 text-center text-xl tracking-[0.5em] bg-muted/40 border-border/60 focus:bg-background" maxLength={6} />
              </div>
              <div className="flex items-center justify-between text-xs text-muted-foreground">
                <span>{otpTimer > 0 ? `Resend in ${otpTimer}s` : 'OTP expired'}</span>
                <button type="button" onClick={resendOtp} disabled={otpTimer > 0}
                  className={cn('flex items-center gap-1 transition-colors',
                    otpTimer > 0 ? 'opacity-40 cursor-not-allowed' : 'text-primary hover:text-primary/80')}>
                  <RefreshCw className="w-3 h-3" /> Resend OTP
                </button>
              </div>
              <Button type="submit" className="w-full h-11 font-semibold" disabled={otp.length !== 6}>
                Verify & Continue <ChevronRight className="w-4 h-4 ml-1" />
              </Button>
            </form>
          )}

          {/* Step 3: Login Passcode */}
          {step === 'passcode' && (
            <div className="space-y-5">
              <div className="bg-muted/30 border border-border rounded-xl p-4 text-center">
                <div className="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-2">
                  <Lock className="w-5 h-5 text-primary" />
                </div>
                <p className="text-sm text-muted-foreground">
                  {passcodeStep === 'create' ? 'Create a 4–6 digit passcode for quick app login' : 'Re-enter to verify your passcode'}
                </p>
              </div>
              <CustomKeypad
                value={passcodeStep === 'create' ? passcode : passcodeConfirm}
                onChange={passcodeStep === 'create' ? setPasscode : setPasscodeConfirm}
                maxLength={6}
                label={passcodeStep === 'create' ? 'Enter Passcode' : 'Confirm Passcode'}
              />
              <Button onClick={handlePasscode} className="w-full h-11 font-semibold"
                disabled={(passcodeStep === 'create' ? passcode : passcodeConfirm).length < 4}>
                {passcodeStep === 'create' ? 'Continue' : 'Confirm Passcode'}
                <ChevronRight className="w-4 h-4 ml-1" />
              </Button>
            </div>
          )}

          {/* Step 4: Secure Transaction PIN */}
          {step === 'pin' && (
            <div className="space-y-5">
              <div className="bg-muted/30 border border-border rounded-xl p-4 text-center">
                <div className="w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-2">
                  <Shield className="w-5 h-5 text-primary" />
                </div>
                <p className="text-sm text-muted-foreground">
                  {pinStep === 'create' ? 'Create a 4-digit transaction PIN' : 'Confirm transaction PIN'}
                </p>
              </div>
              <CustomKeypad
                value={pinStep === 'create' ? pin : pinConfirm}
                onChange={pinStep === 'create' ? setPin : setPinConfirm}
                maxLength={4}
                label={pinStep === 'create' ? 'Enter PIN' : 'Confirm PIN'}
              />
              <Button onClick={handlePin} className="w-full h-11 font-semibold" disabled={loading ||
                (pinStep === 'create' ? pin : pinConfirm).length !== 4}>
                {loading ? <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}
                {pinStep === 'create' ? 'Continue' : 'Complete Setup'}
                <ChevronRight className="w-4 h-4 ml-1" />
              </Button>
            </div>
          )}

          <div className="relative my-6">
            <div className="absolute inset-0 flex items-center">
              <div className="w-full border-t border-border/60" />
            </div>
            <div className="relative flex justify-center">
              <span className="bg-background px-3 text-xs text-muted-foreground">Already have an account?</span>
            </div>
          </div>
          <Link to="/login">
            <Button variant="outline" className="w-full h-11 font-medium">
              Sign In Instead
            </Button>
          </Link>
        </div>
      </div>
    </div>
  );
}