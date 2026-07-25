import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { PortalShell } from '@/components/layouts/PortalShell';
import {
  TrendingUp, Users, Wallet, Megaphone, ArrowRight, CheckCircle2,
  BarChart3, Briefcase, Award
} from 'lucide-react';
import { Link } from 'react-router-dom';

export default function MarketerPortal() {
  return (
    <PortalShell
      title="Marketer Portal"
      subtitle="Earn competitive commissions by referring users, agents, and businesses to IMTechPay."
    >
      <div className="container px-4 py-10 md:py-16">
        <div className="grid md:grid-cols-3 gap-6 mb-12">
          {[
            { label: 'Total Referrals', value: '1,240', icon: Users },
            { label: 'Commissions Earned', value: '₦845,000', icon: Wallet },
            { label: 'Active Campaigns', value: '12', icon: Megaphone },
          ].map((stat) => (
            <Card key={stat.label} className="border bg-card/60">
              <CardContent className="p-6 flex items-center gap-4">
                <div className="p-3 rounded-full bg-primary/10 text-primary">
                  <stat.icon className="w-6 h-6" />
                </div>
                <div>
                  <p className="text-sm text-muted-foreground">{stat.label}</p>
                  <p className="text-2xl font-bold">{stat.value}</p>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>

        <div className="grid lg:grid-cols-2 gap-8 items-start mb-16">
          <div>
            <Badge className="mb-3 bg-success/15 text-success border-success/30">Preview Mode</Badge>
            <h2 className="text-2xl font-bold mb-4">Your marketer dashboard at a glance</h2>
            <p className="text-muted-foreground mb-6">
              Track clicks, conversions, wallet funding events, and commission payouts in real time. The portal also provides marketing creatives and unique referral links.
            </p>
            <ul className="space-y-3 mb-8">
              {[
                'Unique referral code and QR generator',
                'Tiered commission structure with bonuses',
                'Real-time performance charts',
                'Instant wallet credit on confirmed conversions',
                'Priority support channel for top performers',
              ].map((item) => (
                <li key={item} className="flex items-start gap-2 text-sm">
                  <CheckCircle2 className="w-4 h-4 text-success mt-0.5 shrink-0" />
                  {item}
                </li>
              ))}
            </ul>
            <div className="flex flex-wrap gap-3">
              <Button asChild>
                <Link to="/marketer/register">Become a Marketer <ArrowRight className="w-4 h-4 ml-2" /></Link>
              </Button>
              <Button variant="outline" asChild>
                <Link to="/marketer/login">Marketer Login</Link>
              </Button>
            </div>
          </div>

          <Card className="border bg-card/60">
            <CardHeader>
              <CardTitle className="flex items-center gap-2">
                <BarChart3 className="w-5 h-5 text-primary" /> Performance Snapshot
              </CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              {[
                { label: 'This Week Referrals', value: '48', change: '+12%' },
                { label: 'Conversion Rate', value: '8.4%', change: '+1.2%' },
                { label: 'Pending Payout', value: '₦42,000', change: '' },
                { label: 'Lifetime Earnings', value: '₦845,000', change: '+₦120k' },
              ].map((row) => (
                <div key={row.label} className="flex items-center justify-between py-2 border-b last:border-0">
                  <span className="text-sm text-muted-foreground">{row.label}</span>
                  <div className="text-right">
                    <p className="font-semibold">{row.value}</p>
                    {row.change && <p className="text-xs text-success">{row.change}</p>}
                  </div>
                </div>
              ))}
            </CardContent>
          </Card>
        </div>

        <div className="grid md:grid-cols-3 gap-6">
          {[
            { title: 'Referral Tasks', desc: 'Complete daily and weekly tasks to unlock bonus rewards.', icon: Briefcase },
            { title: 'Rank & Badge', desc: 'Climb from Starter to Platinum and enjoy higher commissions.', icon: Award },
            { title: 'Growth Tools', desc: 'Access banners, captions, and co-branded landing pages.', icon: TrendingUp },
          ].map((feature) => (
            <Card key={feature.title} className="border bg-card/60">
              <CardContent className="p-6">
                <feature.icon className="w-8 h-8 text-primary mb-4" />
                <h3 className="font-semibold mb-2">{feature.title}</h3>
                <p className="text-sm text-muted-foreground">{feature.desc}</p>
              </CardContent>
            </Card>
          ))}
        </div>
      </div>
    </PortalShell>
  );
}
