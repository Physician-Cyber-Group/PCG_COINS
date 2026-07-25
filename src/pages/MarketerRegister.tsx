import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { PortalShell } from '@/components/layouts/PortalShell';
import { useState } from 'react';
import { toast } from 'sonner';
import { sendWelcomeEmailPreview } from '@/lib/email-preview';
import { User, Mail, Phone, Lock, ArrowRight, Briefcase } from 'lucide-react';
import { Link } from 'react-router-dom';

export default function MarketerRegister() {
  const [form, setForm] = useState({ fullName: '', email: '', phone: '', referral: '' });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    sendWelcomeEmailPreview({
      email: form.email,
      fullName: form.fullName,
      portal: 'Marketer Portal',
      phone: form.phone,
      referralCode: form.referral,
    });
    toast.success('Marketer application submitted. A welcome email has been prepared for you.');
  };

  return (
    <PortalShell title="Marketer Registration" subtitle="Apply to become a certified IMTechPay marketer and start earning commissions.">
      <div className="container px-4 py-10 md:py-16 flex justify-center">
        <Card className="w-full max-w-lg border bg-card/60">
          <CardHeader className="text-center">
            <div className="mx-auto p-3 rounded-full bg-primary/10 text-primary w-fit mb-3">
              <Briefcase className="w-6 h-6" />
            </div>
            <CardTitle>Apply as a Marketer</CardTitle>
            <CardDescription>Fill in your details. Our team will review and activate your account within 24 hours.</CardDescription>
          </CardHeader>
          <CardContent>
            <form onSubmit={handleSubmit} className="space-y-4">
              <div className="space-y-2">
                <Label htmlFor="fullName">Full Name</Label>
                <div className="relative">
                  <User className="absolute left-3 top-2.5 w-4 h-4 text-muted-foreground" />
                  <Input id="fullName" placeholder="John Doe" className="pl-9" value={form.fullName} onChange={(e) => setForm({ ...form, fullName: e.target.value })} required />
                </div>
              </div>
              <div className="space-y-2">
                <Label htmlFor="email">Email Address</Label>
                <div className="relative">
                  <Mail className="absolute left-3 top-2.5 w-4 h-4 text-muted-foreground" />
                  <Input id="email" type="email" placeholder="john@example.com" className="pl-9" value={form.email} onChange={(e) => setForm({ ...form, email: e.target.value })} required />
                </div>
              </div>
              <div className="space-y-2">
                <Label htmlFor="phone">Phone Number</Label>
                <div className="relative">
                  <Phone className="absolute left-3 top-2.5 w-4 h-4 text-muted-foreground" />
                  <Input id="phone" placeholder="09035777781" className="pl-9" value={form.phone} onChange={(e) => setForm({ ...form, phone: e.target.value })} required />
                </div>
              </div>
              <div className="space-y-2">
                <Label htmlFor="referral">Referral Code (Optional)</Label>
                <div className="relative">
                  <Lock className="absolute left-3 top-2.5 w-4 h-4 text-muted-foreground" />
                  <Input id="referral" placeholder="IMT-XXXX" className="pl-9" value={form.referral} onChange={(e) => setForm({ ...form, referral: e.target.value })} />
                </div>
              </div>
              <Button type="submit" className="w-full">Submit Application <ArrowRight className="w-4 h-4 ml-2" /></Button>
            </form>
            <p className="text-center text-sm text-muted-foreground mt-4">
              Already a marketer? <Link to="/marketer/login" className="text-primary hover:underline">Log in</Link>
            </p>
          </CardContent>
        </Card>
      </div>
    </PortalShell>
  );
}
