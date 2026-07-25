import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { PortalShell } from '@/components/layouts/PortalShell';
import { useState } from 'react';
import { toast } from 'sonner';
import { Mail, Lock, ArrowRight, Briefcase } from 'lucide-react';
import { Link } from 'react-router-dom';

export default function MarketerLogin() {
  const [form, setForm] = useState({ email: '', password: '' });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    toast.success('Marketer login validated (demo).');
  };

  return (
    <PortalShell title="Marketer Login" subtitle="Access your marketer dashboard, referral links, and performance reports.">
      <div className="container px-4 py-10 md:py-16 flex justify-center">
        <Card className="w-full max-w-md border bg-card/60">
          <CardHeader className="text-center">
            <div className="mx-auto p-3 rounded-full bg-primary/10 text-primary w-fit mb-3">
              <Briefcase className="w-6 h-6" />
            </div>
            <CardTitle>Marketer Sign In</CardTitle>
            <CardDescription>Enter your marketer credentials to continue.</CardDescription>
          </CardHeader>
          <CardContent>
            <form onSubmit={handleSubmit} className="space-y-4">
              <div className="space-y-2">
                <Label htmlFor="email">Email</Label>
                <div className="relative">
                  <Mail className="absolute left-3 top-2.5 w-4 h-4 text-muted-foreground" />
                  <Input id="email" type="email" placeholder="marketer@example.com" className="pl-9" value={form.email} onChange={(e) => setForm({ ...form, email: e.target.value })} required />
                </div>
              </div>
              <div className="space-y-2">
                <Label htmlFor="password">Password</Label>
                <div className="relative">
                  <Lock className="absolute left-3 top-2.5 w-4 h-4 text-muted-foreground" />
                  <Input id="password" type="password" placeholder="••••••••" className="pl-9" value={form.password} onChange={(e) => setForm({ ...form, password: e.target.value })} required />
                </div>
              </div>
              <Button type="submit" className="w-full">Sign In <ArrowRight className="w-4 h-4 ml-2" /></Button>
            </form>
            <p className="text-center text-sm text-muted-foreground mt-4">
              Not registered? <Link to="/marketer/register" className="text-primary hover:underline">Apply as a marketer</Link>
            </p>
          </CardContent>
        </Card>
      </div>
    </PortalShell>
  );
}
