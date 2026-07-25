import { Card, CardContent } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { PortalShell } from '@/components/layouts/PortalShell';
import {
  Building2, MapPin, Clock, GraduationCap, Users,
  Briefcase, Headphones, Shield, CheckCircle2
} from 'lucide-react';

const JOBS = [
  { title: 'Enrollment Coordinator', dept: 'HR', type: 'Contract', location: 'Lagos Island', req: 'Degree + operations experience', icon: Users },
  { title: 'Customer Support Lead', dept: 'Operations', type: 'Full-time', location: 'Kano', req: '2+ years support experience', icon: Headphones },
  { title: 'Compliance Officer', dept: 'Risk', type: 'Full-time', location: 'Abuja', req: 'Finance or legal background', icon: Shield },
  { title: 'Field Agent Manager', dept: 'Agency', type: 'Remote', location: 'Nationwide', req: 'Sales & team management', icon: Briefcase },
];

export default function Enrollment() {
  return (
    <PortalShell
      title="Enrollment & Careers"
      subtitle="Join the team shaping the future of digital payments and VTU services in Nigeria."
    >
      <div className="container px-4 py-10 md:py-16">
        <div className="grid lg:grid-cols-2 gap-8 mb-16">
          <div>
            <Badge className="mb-3 bg-primary/15 text-primary border-primary/30">We are hiring</Badge>
            <h2 className="text-2xl font-bold mb-4">Open positions</h2>
            <p className="text-muted-foreground mb-6">
              IMTechPay is building a nationwide network of enrollment officers, support specialists, and compliance professionals. Apply today and grow with us.
            </p>
            <div className="space-y-3 mb-8">
              {[
                'Competitive salary and performance bonuses',
                'Remote-friendly roles for qualified candidates',
                'Career progression into operations or compliance',
                'Training on fintech products and agent banking',
              ].map((benefit) => (
                <div key={benefit} className="flex items-start gap-2 text-sm">
                  <CheckCircle2 className="w-4 h-4 text-primary mt-0.5 shrink-0" />
                  {benefit}
                </div>
              ))}
            </div>
            <div className="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-muted text-muted-foreground font-medium text-sm border border-border">
              <Clock className="w-4 h-4 text-primary" />
              Applicant Registration Coming Soon
            </div>
          </div>

          <div className="grid gap-4">
            {JOBS.map((job) => (
              <Card key={job.title} className="border bg-card/60 hover:border-primary/40 transition-colors">
                <CardContent className="p-5">
                  <div className="flex items-start gap-4">
                    <div className="p-2.5 rounded-full bg-muted text-primary">
                      <job.icon className="w-5 h-5" />
                    </div>
                    <div className="flex-1">
                      <div className="flex flex-wrap items-center gap-2 mb-1">
                        <h3 className="font-semibold">{job.title}</h3>
                        <Badge variant="outline" className="text-xs">{job.type}</Badge>
                      </div>
                      <p className="text-sm text-muted-foreground mb-2">{job.dept} · {job.req}</p>
                      <div className="flex flex-wrap items-center gap-4 text-xs text-muted-foreground">
                        <span className="flex items-center gap-1"><MapPin className="w-3 h-3" /> {job.location}</span>
                        <span className="flex items-center gap-1"><Clock className="w-3 h-3" /> Closes soon</span>
                      </div>
                    </div>
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>
        </div>

        <div className="grid md:grid-cols-3 gap-6">
          {[
            { title: 'How to Apply', desc: 'Create an account, upload your CV, and complete the screening form.', icon: GraduationCap },
            { title: 'Interview Process', desc: 'Phone screen, technical/task assessment, and final interview.', icon: Building2 },
            { title: 'Onboarding', desc: 'Product training, compliance certification, and tools access.', icon: CheckCircle2 },
          ].map((step) => (
            <Card key={step.title} className="border bg-card/60">
              <CardContent className="p-6">
                <step.icon className="w-8 h-8 text-primary mb-4" />
                <h3 className="font-semibold mb-2">{step.title}</h3>
                <p className="text-sm text-muted-foreground">{step.desc}</p>
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    </PortalShell>
  );
}
