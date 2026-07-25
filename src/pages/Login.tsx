// C:\project\IMTechPay-Backup\src\pages\auth\LoginPage.tsx

import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { toast } from 'sonner';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { CustomKeypad } from '@/components/ui/CustomKeypad';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Eye, EyeOff, Loader2, Lock, User, ArrowLeft, Zap, Shield, Smartphone } from 'lucide-react';

const LOGO = './logo.png';

const PERKS = [
  { icon: Zap,        text: 'Airtime, Data, Electricity & more' },
  { icon: Shield,     text: 'Secure Payment Gateways' },
  { icon: Smartphone, text: 'Instant processing with failover routing' },
];


export default function LoginPage() {
  const [loading, setLoading]           = useState(false);
  const [showPassword, setShowPassword] = useState(false);
  const [identifier, setIdentifier]     = useState('');
  const [password, setPassword]         = useState('');
  const [passcode, setPasscode]         = useState('');
  const [loginTab, setLoginTab]         = useState<'password' | 'passcode'>('password');

  const handlePasswordLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!identifier.trim() || !password) {
      toast.error('Please enter your login credentials');
      return;
    }

    setLoading(true);
    await new Promise((resolve) => setTimeout(resolve, 800));
    toast.success('This is a static demo. Login functionality is not connected to a backend.');
    setLoading(false);
  };

  const handlePasscodeLogin = async () => {
    if (passcode.length < 4) {
      toast.error('Enter your passcode');
      return;
    }
    setLoading(true);
    await new Promise((resolve) => setTimeout(resolve, 800));
    toast.success('This is a static demo. Passcode login is not connected to a backend.');
    setLoading(false);
  };

  return (
    <div className="min-h-screen bg-background flex">
      {/* ── Left panel (brand) — desktop only ── */}
      <div className="hidden lg:flex lg:w-[45%] xl:w-[40%] relative flex-col justify-between p-10 overflow-hidden bg-card border-r border-border">
        <div className="absolute inset-0 pointer-events-none">
          <div className="absolute top-0 right-0 w-80 h-80 rounded-full bg-primary/20 blur-[100px]" />
          <div className="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-primary/10 blur-[80px]" />
        </div>
        <div className="relative z-10">
          <Link to="/" className="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors text-sm mb-12">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </Link>
          <div className="flex items-center gap-3 mb-2">
            <img src={LOGO} alt="IMTechPay" className="w-12 h-12 object-contain" />
            <span className="font-bold text-xl font-[Manrope]">IMTechPay</span>
          </div>
          <p className="text-muted-foreground text-sm">Nigeria's premier VTU &amp; bill payment platform</p>
        </div>
        <div className="relative z-10 space-y-4">
          <h2 className="text-2xl font-bold font-[Manrope] leading-tight text-balance">
            Pay Bills &amp; Top Up<br />
            <span className="text-primary">in Seconds</span>
          </h2>
          <div className="space-y-3 mt-4">
            {PERKS.map(({ icon: Icon, text }) => (
              <div key={text} className="flex items-center gap-3 text-sm text-muted-foreground">
                <div className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                  <Icon className="w-4 h-4 text-primary" />
                </div>
                {text}
              </div>
            ))}
          </div>
        </div>
        <div className="relative z-10 flex items-center gap-2 text-xs text-muted-foreground border-t border-border pt-5">
          <Shield className="w-3.5 h-3.5 text-primary" />
          <span>SSL Secured · 200K+ Active Users · Powered by CBN-licensed Payment Partners</span>
        </div>
      </div>

      {/* ── Right panel (form) ── */}
      <div className="flex-1 flex flex-col items-center justify-center p-5 md:p-10 overflow-y-auto">
        <div className="w-full max-w-md mb-6 lg:hidden">
          <Link to="/" className="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-primary transition-colors">
            <ArrowLeft className="w-4 h-4" /> Back to Home
          </Link>
        </div>

        <div className="w-full max-w-md">
          {/* Mobile logo */}
          <div className="flex items-center gap-2.5 mb-7 lg:hidden">
            <img src={LOGO} alt="IMTechPay" className="w-10 h-10 object-contain" />
            <span className="font-bold text-base font-[Manrope]">IMTechPay</span>
          </div>

          <div className="mb-6">
            <h1 className="text-2xl font-extrabold text-foreground font-[Manrope]">Welcome back</h1>
            <p className="text-muted-foreground text-sm mt-1">Sign in to your account to continue</p>
          </div>

          {/* Identifier field */}
          <div className="space-y-1.5 mb-5">
            <Label htmlFor="identifier" className="text-xs font-medium">Username, Phone</Label>
            <div className="relative">
              <User className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
              <Input id="identifier" placeholder="johndoe / 09035777781" value={identifier}
                onChange={e => setIdentifier(e.target.value)}
                className="h-11 text-sm pl-9 bg-muted/40 border-border/60 focus:bg-background" />
            </div>
          </div>

          <Tabs value={loginTab} onValueChange={v => setLoginTab(v as 'password' | 'passcode')}>
            <TabsList className="w-full mb-5 h-9 bg-muted/50">
              <TabsTrigger value="password" className="flex-1 text-xs h-7">Password</TabsTrigger>
              <TabsTrigger value="passcode" className="flex-1 text-xs h-7">Passcode</TabsTrigger>
            </TabsList>

            <TabsContent value="password">
              <form onSubmit={handlePasswordLogin} className="space-y-4">
                <div className="space-y-1.5">
                  <div className="flex items-center justify-between">
                    <Label htmlFor="password" className="text-xs font-medium">Password</Label>
                    <button type="button" className="text-xs text-primary hover:text-primary/80 transition-colors">
                      Forgot password?
                    </button>
                  </div>
                  <div className="relative">
                    <Lock className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" />
                    <Input id="password" type={showPassword ? 'text' : 'password'} placeholder="Enter your password"
                      value={password} onChange={e => setPassword(e.target.value)}
                      className="h-11 text-sm pl-9 pr-10 bg-muted/40 border-border/60 focus:bg-background" />
                    <button type="button" onClick={() => setShowPassword(v => !v)}
                      className="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground transition-colors">
                      {showPassword ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
                    </button>
                  </div>
                </div>
                <Button type="submit" className="w-full h-11 font-semibold" disabled={loading || !identifier || !password}>
                  {loading ? <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}Sign In
                </Button>
              </form>
            </TabsContent>

            <TabsContent value="passcode">
              <div className="space-y-4">
                <CustomKeypad value={passcode} onChange={setPasscode} maxLength={6} label="Enter your passcode" />
                <Button onClick={handlePasscodeLogin} className="w-full h-11 font-semibold" disabled={loading || passcode.length < 4}>
                  {loading ? <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}Sign In with Passcode
                </Button>
              </div>
            </TabsContent>
          </Tabs>

          <div className="relative my-6">
            <div className="absolute inset-0 flex items-center"><div className="w-full border-t border-border/60" /></div>
            <div className="relative flex justify-center"><span className="bg-background px-3 text-xs text-muted-foreground">or</span></div>
          </div>

          <p className="text-center text-sm text-muted-foreground">
            Don't have an account?{' '}
            <Link to="/register" className="text-primary hover:text-primary/80 font-semibold transition-colors">Create Account</Link>
          </p>

          <div className="flex items-center justify-center gap-4 mt-5 pt-5 border-t border-border/40">
            {[
              { label: 'Marketer Portal', to: '/marketer/login' },
              { label: 'Enrollment',      to: '/enrollment' },
            ].map(l => (
              <Link key={l.to} to={l.to} className="text-xs text-muted-foreground hover:text-primary transition-colors">{l.label}</Link>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}

