import { useState, useEffect, useCallback } from 'react';
import { Link } from 'react-router-dom';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import {
  Smartphone, Zap, Shield, TrendingUp, Globe, Star,
  ChevronRight, CheckCircle2, Wifi, Tv, Bolt,
  MessageSquare, CreditCard, Phone, FileText, Menu, X,
  ArrowRight, Play, Award, Lock, BarChart3, Headphones,
  Megaphone, ChevronLeft, Code2, Terminal, Key, Briefcase,
  UserCheck, MapPin, ExternalLink, Layers, Building2,
  GraduationCap, IndentIncrease, Trophy, Medal, Gift, CalendarDays,
} from 'lucide-react';
import { cn } from '@/lib/utils';
import { format } from 'date-fns';

const LOGO = './logo.png';

const ADVERTS = [
  { type: 'announcement', tag: 'New Feature', tagColor: 'bg-primary/15 text-primary border-primary/30', title: 'Airtime to Cash is Now Live!', body: 'Convert your excess airtime to instant wallet credit. Available for all Tier 1+ users across MTN, Airtel, Glo & 9mobile.', cta: 'Try Now', ctaLink: '/register', icon: Smartphone },
  { type: 'update', tag: 'Platform Update', tagColor: 'bg-success/15 text-success border-success/30', title: 'Tier 3 API Access is Open', body: 'Build your own VTU business with our robust REST API. Full documentation, sandbox environment, and instant keys.', cta: 'View API Docs', ctaLink: '/api-docs', icon: Code2 },
  { type: 'job', tag: 'We\'re Hiring', tagColor: 'bg-warning/15 text-warning border-warning/30', title: 'Join the IMTechPay Team', body: 'Exciting roles in engineering, operations, customer support, and compliance. Apply through our Enrollment Portal today.', cta: 'View Open Roles', ctaLink: '/enrollment', icon: GraduationCap },
  { type: 'marketer', tag: 'Earn with Us', tagColor: 'bg-accent/15 text-accent border-accent/30', title: 'Become a Certified Marketer', body: 'Register as an IMTechPay marketer. Get jobs auto-assigned, complete tasks and earn commissions on every transaction.', cta: 'Register Now', ctaLink: '/marketer/register', icon: Briefcase },
  { type: 'update', tag: 'Security', tagColor: 'bg-info/15 text-info border-info/30', title: 'Enhanced Tier Verification System', body: 'Our new bank micro-transfer verification system ensures only genuine account holders can upgrade to Tier 1 and above.', cta: 'Upgrade Tier', ctaLink: '/login', icon: Shield },
];

const JOB_POSITIONS = [
  { title: 'Customer Support Officer', dept: 'Operations', type: 'Full-time', location: 'Lagos Island', req: 'HND/BSc + communication skills', icon: Headphones },
  { title: 'Operations Analyst', dept: 'Finance & Ops', type: 'Full-time', location: 'Remote', req: 'BSc Finance / Computer Science', icon: BarChart3 },
  { title: 'Enrollment Coordinator', dept: 'HR', type: 'Contract', location: 'Lagos Island', req: 'Degree + operations experience', icon: Building2 },
  { title: 'Frontend Engineer', dept: 'Engineering', type: 'Full-time', location: 'Remote', req: 'React/TypeScript, 2+ years exp.', icon: Code2 },
];

const MARKETER_BENEFITS = [
  { icon: Zap, title: 'Auto-Assigned Jobs', desc: 'Every user payment auto-generates a job. Be the first marketer to claim it.' },
  { icon: Shield, title: 'Secure Earnings', desc: 'All commissions tracked in your wallet. Withdraw to your verified bank account anytime.' },
  { icon: TrendingUp, title: 'Grow Your Income', desc: 'The more jobs you complete, the higher your ranking and the more priority assignments you receive.' },
  { icon: UserCheck, title: 'Simple Onboarding', desc: 'Register with NIN, BVN, and shop photos. Our AI verifies your identity automatically.' },
];

const API_ENDPOINTS = [
  { method: 'POST', path: '/v1/airtime/purchase', desc: 'Purchase airtime for any network' },
  { method: 'POST', path: '/v1/data/purchase', desc: 'Buy data bundles programmatically' },
  { method: 'GET',  path: '/v1/wallet/balance', desc: 'Retrieve wallet balance in real time' },
  { method: 'POST', path: '/v1/bills/electricity', desc: 'Pay electricity bills via API' },
  { method: 'GET',  path: '/v1/transactions', desc: 'List all transactions with filters' },
];

const SERVICES = [
  { icon: Phone, label: 'Airtime & Data', desc: 'Top up any network instantly', color: 'text-primary', bg: 'bg-primary/10' },
  { icon: Bolt, label: 'Electricity', desc: 'Pay PHCN & DisCo bills', color: 'text-yellow-400', bg: 'bg-yellow-400/10' },
  { icon: Tv, label: 'Cable TV', desc: 'DStv, GOtv, Startimes', color: 'text-purple-400', bg: 'bg-purple-400/10' },
  { icon: Wifi, label: 'Internet / WiFi', desc: 'Spectranet, Smile & more', color: 'text-sky-400', bg: 'bg-sky-400/10' },
  { icon: Globe, label: 'Cybercafe Services', desc: 'Internet browsing, Online result checking, Project, portal registrations & printing', color: 'text-green-400', bg: 'bg-green-400/10' },
  { icon: FileText, label: 'NIN / BVN', desc: 'Identity verification, validation, Personalization, IPE Clearance and Modification', color: 'text-orange-400', bg: 'bg-orange-400/10' },
  { icon: CreditCard, label: 'Exam Pins', desc: 'WAEC, JAMB, NECO', color: 'text-rose-400', bg: 'bg-rose-400/10' },
  { icon: MessageSquare, label: 'Bulk SMS', desc: 'Reach thousands instantly', color: 'text-indigo-400', bg: 'bg-indigo-400/10' },
  { icon: Smartphone, label: 'Airtime to Cash', desc: 'Convert airtime to money', color: 'text-teal-400', bg: 'bg-teal-400/10' },
];

const FEATURES = [
  { icon: Shield, title: 'Secure Payment Gateways', desc: 'Zero-trust architecture, device fingerprinting, and real-time fraud detection protect every transaction.' },
  { icon: Zap, title: 'Instant Processing', desc: 'Multi-provider failover routing ensures your transactions are processed in milliseconds, every time.' },
  { icon: TrendingUp, title: 'Tiered Rewards', desc: 'Climb from Tier 0 to Tier 3 and unlock higher limits, virtual accounts, white-label capabilities.' },
  { icon: Globe, title: 'White-Label Platform', desc: 'Tier 3 users get a fully branded sub-platform to resell our services under their own identity.' },
  { icon: BarChart3, title: 'Full Transaction Ledger', desc: 'Double-entry accounting with downloadable PDF receipts, monthly navigation, and full audit trail.' },
  { icon: Headphones, title: 'AI + Live Support', desc: 'Our AI assistant handles common queries instantly and escalates to live agents seamlessly.' },
];

const TIERS = [
  { tier: '0', label: 'Starter', limit: '₦0', color: 'border-muted', badge: 'bg-muted text-muted-foreground', perks: ['No Transaction', 'SMS OTP', 'View OUR Services'] },
  { tier: '1', label: 'Basic', limit: '₦5,000', color: 'border-primary/40', badge: 'bg-primary/15 text-primary', perks: ['All Tier 0 perks', 'Bank account verified', 'Higher limits'] },
  { tier: '2', label: 'Verified', limit: '₦300,000', color: 'border-primary/70', badge: 'bg-primary/25 text-primary', perks: ['Virtual accounts', 'NIN/BVN verified', 'Moniepoint, OPay, PalmPay'], highlight: true },
  { tier: '3', label: 'Business', limit: '₦5,000,000', color: 'border-primary', badge: 'bg-primary text-primary-foreground', perks: ['White-label platform', 'API access', 'Unlimited potential'] },
];

const STATS = [
  { value: '10K+', label: 'Registered Users' },
  { value: '₦200K+', label: 'Transactions Processed' },
  { value: '99.9%', label: 'Uptime SLA' },
  { value: '< 3s', label: 'Average Processing Time' },
];

// ── Promo Winners Section ────────────────────────────────────────────────────
interface PromoWinnerEvent {
  id: string;
  event_name: string;
  event_location: string;
  event_school?: string;
  promo_code: string;
  updated_at: string;
  winners: { rank: number; name: string; score: number }[];
}

function PromoWinnersSection() {
  const [showOlder, setShowOlder] = useState(false);

  const events: PromoWinnerEvent[] = [
    {
      id: '1',
      event_name: 'Lagos Island Awareness Drive',
      event_location: 'Lagos Island',
      event_school: 'University of Lagos',
      promo_code: 'LAGOS-2026',
      updated_at: '2026-07-20T10:00:00Z',
      winners: [
        { rank: 1, name: 'Adaobi M.', score: 20 },
        { rank: 2, name: 'Emeka T.', score: 19 },
        { rank: 3, name: 'Fatima A.', score: 18 },
        { rank: 4, name: 'John D.', score: 16 },
        { rank: 5, name: 'Amina S.', score: 15 },
      ],
    },
    {
      id: '2',
      event_name: 'Abuja Tech Fair',
      event_location: 'Abuja',
      promo_code: 'ABUJA-2026',
      updated_at: '2026-06-15T14:00:00Z',
      winners: [
        { rank: 1, name: 'Oluwaseun K.', score: 20 },
        { rank: 2, name: 'Ngozi I.', score: 19 },
        { rank: 3, name: 'Hassan B.', score: 17 },
      ],
    },
  ];

  if (events.length === 0) return null;

  const latest = events[0];
  const olderEvents = events.slice(1);
  const medalColors = ['text-yellow-400', 'text-slate-400', 'text-amber-600'];

  return (
    <section id="promo-winners" className="py-20 bg-muted/20 border-y border-border">
      <div className="max-w-5xl mx-auto px-4 md:px-8">
        {/* Heading */}
        <div className="text-center mb-10">
          <Badge className="bg-primary/15 text-primary border-primary/30 mb-3"><Trophy className="w-3 h-3 mr-1" /> Promo Winners</Badge>
          <h2 className="text-2xl md:text-3xl font-extrabold font-[Manrope] text-balance">Quiz Competition Leaderboard</h2>
          <p className="text-muted-foreground text-sm mt-2 max-w-md mx-auto">
            Top 10 scorers from each awareness event win 5GB Data + ₦1,000 Airtime
          </p>
        </div>

        {/* ── Latest promo ── */}
        <div className="card-surface p-5 mb-5 border-primary/20">
          <div className="flex items-start gap-4 flex-wrap mb-4">
            <div className="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
              <Trophy className="w-6 h-6 text-primary" />
            </div>
            <div className="flex-1 min-w-0">
              <div className="flex items-center gap-2 flex-wrap mb-0.5">
                <h3 className="font-bold text-base">{latest.event_name}</h3>
                <Badge className="text-[10px] bg-primary/15 text-primary border-primary/20">Latest</Badge>
              </div>
              <div className="flex items-center gap-3 text-xs text-muted-foreground flex-wrap">
                <span className="flex items-center gap-1"><MapPin className="w-3 h-3" />{latest.event_location}</span>
                {latest.event_school && <span className="flex items-center gap-1"><GraduationCap className="w-3 h-3" />{latest.event_school}</span>}
                <span className="flex items-center gap-1"><CalendarDays className="w-3 h-3" />{format(new Date(latest.updated_at), 'dd MMM yyyy')}</span>
              </div>
              <div className="mt-1.5 flex items-center gap-2">
                <Gift className="w-3.5 h-3.5 text-primary" />
                <span className="text-xs text-primary font-medium">5GB Data + ₦1,000 Airtime for Top 10</span>
              </div>
            </div>
          </div>

          {latest.winners.length === 0 ? (
            <p className="text-center text-sm text-muted-foreground py-4">Results pending — quiz not yet completed.</p>
          ) : (
            <div className="grid md:grid-cols-2 gap-2.5">
              {latest.winners.map((w) => (
                <div key={w.rank}
                  className={cn('flex items-center gap-3 p-3 rounded-md border',
                    w.rank <= 3 ? 'border-primary/20 bg-primary/5' : 'border-border bg-card')}>
                  <div className="w-7 h-7 rounded-full flex items-center justify-center shrink-0 bg-muted">
                    {w.rank <= 3
                      ? <Medal className={cn('w-3.5 h-3.5', medalColors[w.rank - 1])} />
                      : <span className="text-xs font-bold text-muted-foreground">{w.rank}</span>}
                  </div>
                  <div className="flex-1 min-w-0">
                    <p className="font-semibold text-sm truncate">{w.name}</p>
                    <p className="text-xs text-muted-foreground">Score: {w.score}/20</p>
                  </div>
                  <CheckCircle2 className="w-3.5 h-3.5 text-success shrink-0" />
                </div>
              ))}
            </div>
          )}
        </div>

        {/* ── View Older Promos button ── */}
        {olderEvents.length > 0 && (
          <div className="text-center mb-5">
            <button
              onClick={() => setShowOlder(v => !v)}
              className="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-border text-sm text-muted-foreground hover:border-primary/40 hover:text-primary transition-colors">
              <ChevronRight className={cn('w-4 h-4 transition-transform', showOlder && 'rotate-90')} />
              {showOlder ? 'Hide Older Promos' : `View ${olderEvents.length} Older Promo${olderEvents.length > 1 ? 's' : ''}`}
            </button>
          </div>
        )}

        {/* ── Older promos list ── */}
        {showOlder && olderEvents.length > 0 && (
          <div className="space-y-4 mt-2">
            <h3 className="text-sm font-semibold text-muted-foreground uppercase tracking-wide">Past Promo Events</h3>
            {olderEvents.map((event) => (
              <div key={event.id} className="card-surface p-4">
                <div className="flex items-start gap-3 flex-wrap mb-3">
                  <div className="w-9 h-9 rounded-lg bg-muted flex items-center justify-center shrink-0">
                    <Trophy className="w-4 h-4 text-muted-foreground" />
                  </div>
                  <div className="flex-1 min-w-0">
                    <h4 className="font-semibold text-sm">{event.event_name}</h4>
                    <div className="flex items-center gap-3 text-xs text-muted-foreground flex-wrap mt-0.5">
                      <span className="flex items-center gap-1"><MapPin className="w-3 h-3" />{event.event_location}</span>
                      {event.event_school && <span>{event.event_school}</span>}
                      <span className="flex items-center gap-1"><CalendarDays className="w-3 h-3" />{format(new Date(event.updated_at), 'dd MMM yyyy')}</span>
                    </div>
                    <code className="text-[10px] text-muted-foreground font-mono mt-1 inline-block">{event.promo_code}</code>
                  </div>
                </div>
                {event.winners.length === 0 ? (
                  <p className="text-xs text-muted-foreground italic">No recorded winners for this event.</p>
                ) : (
                  <div className="grid grid-cols-2 md:grid-cols-3 gap-2">
                    {event.winners.map((w) => (
                      <div key={w.rank} className="flex items-center gap-2 text-xs">
                        <span className={cn('font-bold w-4 shrink-0', w.rank <= 3 ? medalColors[w.rank - 1] : 'text-muted-foreground')}>
                          #{w.rank}
                        </span>
                        <span className="truncate text-foreground">{w.name}</span>
                        <span className="shrink-0 text-muted-foreground ml-auto">{w.score}/20</span>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            ))}
          </div>
        )}

        <p className="text-center text-xs text-muted-foreground mt-8">
          Participate in our next awareness event by registering with a promo code.{' '}
          <Link to="/register" className="text-primary hover:underline">Create Account →</Link>
        </p>
      </div>
    </section>
  );
}

const TESTIMONIALS = [
  { name: 'Adaeze O.', role: 'Business Owner, Lagos', text: 'IMTechPay has completely transformed how I manage bills and airtime for my staff. The white-label feature is exceptional.' },
  { name: 'Emeka T.', role: 'Student, Abuja', text: 'Fast, reliable, and always available. I never run out of data anymore thanks to the auto-detect network feature.' },
  { name: 'Fatima A.', role: 'Entrepreneur, Kano', text: 'The tier system motivated me to grow. I\'m now Tier 3 and running my own sub-platform. Incredible!' },
];

export default function HomePage() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [advertIdx, setAdvertIdx] = useState(0);

  const prevAdvert = useCallback(() => setAdvertIdx(i => (i - 1 + ADVERTS.length) % ADVERTS.length), []);
  const nextAdvert = useCallback(() => setAdvertIdx(i => (i + 1) % ADVERTS.length), []);

  useEffect(() => {
    const handler = () => setScrolled(window.scrollY > 40);
    window.addEventListener('scroll', handler);
    return () => window.removeEventListener('scroll', handler);
  }, []);

  // Auto-advance carousel
  useEffect(() => {
    const t = setInterval(nextAdvert, 5000);
    return () => clearInterval(t);
  }, [nextAdvert]);

  return (
    <div className="min-h-screen bg-background text-foreground overflow-x-hidden">
      {/* ── Navbar ── */}
      <header className={cn(
        'fixed top-0 inset-x-0 z-50 transition-all duration-300',
        scrolled ? 'bg-background/95 backdrop-blur border-b border-border shadow-sm' : 'bg-transparent'
      )}>
        <div className="max-w-7xl mx-auto px-4 md:px-8 h-16 flex items-center justify-between">
          <Link to="/" className="flex items-center gap-2.5">
            <img src={LOGO} alt="IMTechPay" className="w-9 h-9 object-contain" />
            <span className="font-bold text-lg font-[Manrope] text-foreground">IMTechPay</span>
          </Link>

          {/* Desktop nav */}
          <nav className="hidden md:flex items-center gap-6 text-sm text-muted-foreground">
            <a href="#adverts" className="hover:text-primary transition-colors">Updates</a>
            <a href="#services" className="hover:text-primary transition-colors">Services</a>
            <a href="#jobs" className="hover:text-primary transition-colors">Careers</a>
            <a href="#marketers" className="hover:text-primary transition-colors">Marketers</a>
            <a href="#api" className="hover:text-primary transition-colors">API</a>
            <a href="#tiers" className="hover:text-primary transition-colors">Tiers</a>
          </nav>

          <div className="hidden md:flex items-center gap-3">
            <Link to="/login">
              <Button variant="ghost" size="sm" className="text-sm">Sign In</Button>
            </Link>
            <Link to="/register">
              <Button size="sm" className="text-sm px-5">Get Started</Button>
            </Link>
          </div>

          {/* Mobile menu button */}
          <button
            className="md:hidden p-2 rounded-md text-muted-foreground hover:text-foreground"
            onClick={() => setMobileMenuOpen(v => !v)}
          >
            {mobileMenuOpen ? <X className="w-5 h-5" /> : <Menu className="w-5 h-5" />}
          </button>
        </div>

        {/* Mobile menu */}
        {mobileMenuOpen && (
          <div className="md:hidden bg-background/98 backdrop-blur border-b border-border px-4 pb-5 space-y-1">
            {['#adverts:Updates', '#services:Services', '#jobs:Careers', '#marketers:Marketers', '#api:API', '#tiers:Tiers'].map((item) => {
              const [href, label] = item.split(':');
              return (
                <a key={href} href={href} onClick={() => setMobileMenuOpen(false)}
                  className="block py-2.5 text-sm text-muted-foreground hover:text-primary capitalize border-b border-border/50 last:border-0">
                  {label}
                </a>
              );
            })}
            <div className="flex gap-3 pt-3">
              <Link to="/login" className="flex-1" onClick={() => setMobileMenuOpen(false)}>
                <Button variant="outline" size="sm" className="w-full">Sign In</Button>
              </Link>
              <Link to="/register" className="flex-1" onClick={() => setMobileMenuOpen(false)}>
                <Button size="sm" className="w-full">Get Started</Button>
              </Link>
            </div>
          </div>
        )}
      </header>

      {/* ── Hero ── */}
      <section className="relative min-h-screen flex items-center pt-16 overflow-hidden">
        {/* Background gradient blobs */}
        <div className="absolute inset-0 pointer-events-none z-0">
          <div className="absolute top-1/4 -left-32 w-96 h-96 rounded-full bg-primary/20 blur-[120px]" />
          <div className="absolute bottom-1/4 -right-32 w-96 h-96 rounded-full bg-primary/10 blur-[100px]" />
          <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-primary/5 blur-[150px]" />
        </div>

        <div className="relative z-10 max-w-7xl mx-auto px-4 md:px-8 w-full">
          <div className="grid md:grid-cols-2 gap-12 items-center">
            {/* Left: copy */}
            <div className="space-y-6">
              <Badge className="bg-primary/15 text-primary border-primary/30 px-3 py-1 text-xs font-medium">
                Nigeria's Premier VTU Platform
              </Badge>

              <h1 className="text-4xl md:text-5xl lg:text-6xl font-extrabold font-[Manrope] leading-tight text-balance">
                Pay Bills &{' '}
                <span className="text-transparent bg-clip-text" style={{ backgroundImage: 'linear-gradient(135deg, hsl(var(--primary)), hsl(var(--accent)))' }}>
                  Top Up
                </span>{' '}
                Instantly
              </h1>

              <p className="text-muted-foreground text-lg leading-relaxed max-w-lg">
                Airtime, data, electricity, cable TV, NIN, WAEC pins — all in one secure platform.
                Trusted by 200,000+ Nigerians for fast, reliable, and affordable transactions.
              </p>

              <div className="flex flex-col sm:flex-row gap-3">
                <Link to="/register">
                  <Button size="lg" className="h-12 px-7 text-base font-semibold gap-2">
                    Create Free Account <ArrowRight className="w-4 h-4" />
                  </Button>
                </Link>
                <a href="#services">
                  <Button size="lg" variant="outline" className="h-12 px-7 text-base gap-2">
                    <Play className="w-4 h-4" /> Explore Services
                  </Button>
                </a>
              </div>

              {/* Trust indicators */}
              <div className="flex flex-wrap gap-4 pt-2">
                {['Secure Payment Gateways', 'Instant Processing', 'Free to Join'].map(t => (
                  <div key={t} className="flex items-center gap-1.5 text-xs text-muted-foreground">
                    <CheckCircle2 className="w-3.5 h-3.5 text-primary" />
                    <span>{t}</span>
                  </div>
                ))}
              </div>
            </div>

            {/* Right: floating dashboard card */}
            <div className="hidden md:flex justify-center">
              <div className="relative w-full max-w-sm">
                {/* Main card */}
                <div className="bg-card border border-border rounded-2xl p-6 shadow-2xl">
                  <div className="flex items-center gap-3 mb-5">
                    <img src={LOGO} alt="IMTechPay" className="w-10 h-10 object-contain" />
                    <div>
                      <p className="font-semibold text-sm">Wallet Balance</p>
                      <p className="text-2xl font-bold text-primary font-[Manrope]">₦24,500.00</p>
                    </div>
                  </div>
                  {/* Quick services grid */}
                  <div className="grid grid-cols-4 gap-2 mb-4">
                    {[
                      { icon: Phone, label: 'Airtime' },
                      { icon: Wifi, label: 'Data' },
                      { icon: Bolt, label: 'Electricity' },
                      { icon: Tv, label: 'Cable TV' },
                    ].map(({ icon: Icon, label }) => (
                      <div key={label} className="flex flex-col items-center gap-1.5 p-2 rounded-xl bg-muted/60 hover:bg-primary/10 transition-colors cursor-pointer">
                        <Icon className="w-5 h-5 text-primary" />
                        <span className="text-[10px] text-muted-foreground">{label}</span>
                      </div>
                    ))}
                  </div>
                  {/* Recent txns */}
                  <p className="text-xs font-semibold text-muted-foreground mb-2">Recent Transactions</p>
                  {[
                    { label: 'MTN Airtime ×09035777781', amount: '-₦500', color: 'text-destructive' },
                    { label: 'Wallet Funding', amount: '+₦5,000', color: 'text-success' },
                    { label: 'DSTV — Compact', amount: '-₦4,200', color: 'text-destructive' },
                  ].map((tx, i) => (
                    <div key={i} className="flex items-center justify-between py-1.5 border-b border-border/40 last:border-0">
                      <p className="text-xs text-foreground truncate flex-1">{tx.label}</p>
                      <span className={cn('text-xs font-semibold ml-2 shrink-0', tx.color)}>{tx.amount}</span>
                    </div>
                  ))}
                </div>

                {/* Floating badge top-right */}
                <div className="absolute -top-4 -right-4 bg-primary text-primary-foreground text-xs font-bold rounded-xl px-3 py-1.5 shadow-lg">
                  Tier 2 Verified
                </div>
                {/* Floating badge bottom-left */}
                <div className="absolute -bottom-4 -left-4 bg-card border border-border text-xs rounded-xl px-3 py-2 shadow-lg flex items-center gap-2">
                  <Zap className="w-3.5 h-3.5 text-primary" />
                  <span className="font-medium">Processed in 1.2s</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── Stats ── */}
      <section className="py-14 border-y border-border bg-muted/20">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            {STATS.map(s => (
              <div key={s.label} className="space-y-1">
                <p className="text-3xl font-extrabold text-primary font-[Manrope]">{s.value}</p>
                <p className="text-sm text-muted-foreground">{s.label}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── Adverts / Recent Developments ── */}
      <section id="adverts" className="py-16 bg-muted/20 border-y border-border">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="flex items-center justify-between mb-8">
            <div>
              <div className="flex items-center gap-2 mb-1">
                <Megaphone className="w-4 h-4 text-primary" />
                <Badge className="bg-primary/10 text-primary border-primary/20">Latest Updates</Badge>
              </div>
              <h2 className="text-2xl md:text-3xl font-bold font-[Manrope] text-balance">What's New at IMTechPay</h2>
            </div>
            <div className="hidden md:flex gap-2">
              <button onClick={prevAdvert} className="w-9 h-9 rounded-full border border-border flex items-center justify-center hover:bg-muted transition-colors">
                <ChevronLeft className="w-4 h-4" />
              </button>
              <button onClick={nextAdvert} className="w-9 h-9 rounded-full border border-border flex items-center justify-center hover:bg-muted transition-colors">
                <ChevronRight className="w-4 h-4" />
              </button>
            </div>
          </div>

          {/* Featured advert */}
          <div className="grid md:grid-cols-5 gap-4">
            {/* Main card */}
            <div className="md:col-span-3 bg-card border border-border rounded-2xl p-8 flex flex-col justify-between min-h-[220px] relative overflow-hidden transition-all duration-300">
              <div className="absolute inset-0 pointer-events-none">
                <div className="absolute top-0 right-0 w-64 h-64 rounded-full bg-primary/5 blur-[80px]" />
              </div>
              <div className="relative z-10">
                <Badge className={cn('text-xs border mb-4', ADVERTS[advertIdx].tagColor)}>{ADVERTS[advertIdx].tag}</Badge>
                <h3 className="text-xl font-bold font-[Manrope] mb-2 text-balance">{ADVERTS[advertIdx].title}</h3>
                <p className="text-sm text-muted-foreground leading-relaxed mb-5">{ADVERTS[advertIdx].body}</p>
                <Link to={ADVERTS[advertIdx].ctaLink}>
                  <Button size="sm" className="gap-2 h-9">
                    {ADVERTS[advertIdx].cta} <ArrowRight className="w-3.5 h-3.5" />
                  </Button>
                </Link>
              </div>
            </div>

            {/* Side cards (next 2) */}
            <div className="md:col-span-2 flex flex-col gap-4">
              {[1, 2].map(offset => {
                const ad = ADVERTS[(advertIdx + offset) % ADVERTS.length];
                const Icon = ad.icon;
                return (
                  <div key={offset} className="bg-card border border-border rounded-xl p-5 flex gap-4 items-start hover:border-primary/30 transition-colors cursor-pointer"
                    onClick={() => setAdvertIdx((advertIdx + offset) % ADVERTS.length)}>
                    <div className="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                      <Icon className="w-5 h-5 text-primary" />
                    </div>
                    <div className="flex-1 min-w-0">
                      <Badge className={cn('text-[10px] border mb-1', ad.tagColor)}>{ad.tag}</Badge>
                      <p className="text-sm font-semibold truncate">{ad.title}</p>
                      <p className="text-xs text-muted-foreground line-clamp-2 mt-0.5">{ad.body}</p>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>

          {/* Dots */}
          <div className="flex justify-center gap-2 mt-6">
            {ADVERTS.map((_, i) => (
              <button key={i} onClick={() => setAdvertIdx(i)}
                className={cn('w-2 h-2 rounded-full transition-all', i === advertIdx ? 'bg-primary w-6' : 'bg-border hover:bg-muted-foreground')} />
            ))}
          </div>
        </div>
      </section>

      {/* ── Services ── */}
      <section id="services" className="py-20">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="text-center mb-12">
            <Badge className="bg-primary/10 text-primary border-primary/20 mb-4">What We Offer</Badge>
            <h2 className="text-3xl md:text-4xl font-bold font-[Manrope] mb-3 text-balance">
              Everything You Need, In One Place
            </h2>
            <p className="text-muted-foreground max-w-xl mx-auto">
              From airtime top-ups to identity verification — all services powered by multi-provider failover routing for maximum reliability.
            </p>
          </div>

          <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 gap-4">
            {SERVICES.map(({ icon: Icon, label, desc, color, bg }) => (
              <div key={label}
                className="group bg-card border border-border rounded-2xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200 cursor-pointer">
                <div className={cn('w-11 h-11 rounded-xl flex items-center justify-center mb-3 transition-transform group-hover:scale-110', bg)}>
                  <Icon className={cn('w-5 h-5', color)} />
                </div>
                <p className="font-semibold text-sm mb-1">{label}</p>
                <p className="text-xs text-muted-foreground leading-relaxed">{desc}</p>
              </div>
            ))}
          </div>

          <div className="text-center mt-8">
            <Link to="/register">
              <Button variant="outline" className="gap-2">
                Access All Services <ChevronRight className="w-4 h-4" />
              </Button>
            </Link>
          </div>
        </div>
      </section>

      {/* ── Job Opportunities ── */}
      <section id="jobs" className="py-20 bg-muted/20 border-y border-border">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="grid md:grid-cols-2 gap-12 items-center">
            <div>
              <Badge className="bg-warning/10 text-warning border-warning/20 mb-4">Careers</Badge>
              <h2 className="text-3xl md:text-4xl font-bold font-[Manrope] mb-4 text-balance">
                Join the IMTechPay Team
              </h2>
              <p className="text-muted-foreground leading-relaxed mb-6">
                We're building Nigeria's most trusted fintech platform. We're looking for passionate people who want to make a real impact in financial inclusion. Apply through our Enrollment Portal — all applications are reviewed by our AI-assisted hiring system.
              </p>
              <div className="flex flex-wrap gap-4 mb-7">
                {[['100%', 'Remote-Friendly'], ['AI-Assisted', 'Fair Hiring'], ['2-Month', 'Trial Salary'], ['Growth', 'Path Defined']].map(([val, lbl]) => (
                  <div key={lbl} className="text-center">
                    <p className="text-base font-bold text-primary">{val}</p>
                    <p className="text-xs text-muted-foreground">{lbl}</p>
                  </div>
                ))}
              </div>
              <Link to="/enrollment">
                <Button size="lg" className="gap-2 h-11">
                  <GraduationCap className="w-4 h-4" /> Apply via Enrollment Portal
                </Button>
              </Link>
            </div>

            <div className="space-y-3">
              {JOB_POSITIONS.map(({ title, dept, type, location, req, icon: Icon }) => (
                <div key={title} className="bg-card border border-border rounded-xl p-4 flex items-start gap-4 hover:border-primary/30 hover:shadow-md hover:shadow-primary/5 transition-all group">
                  <div className="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary/20 transition-colors">
                    <Icon className="w-5 h-5 text-primary" />
                  </div>
                  <div className="flex-1 min-w-0">
                    <div className="flex items-start justify-between gap-2 flex-wrap">
                      <p className="font-semibold text-sm">{title}</p>
                      <Badge className="text-[10px] bg-primary/10 text-primary border-primary/20 shrink-0">{type}</Badge>
                    </div>
                    <p className="text-xs text-muted-foreground mt-0.5">{dept}</p>
                    <div className="flex flex-wrap gap-x-3 gap-y-1 mt-2">
                      <span className="flex items-center gap-1 text-[11px] text-muted-foreground">
                        <MapPin className="w-3 h-3" />{location}
                      </span>
                      <span className="flex items-center gap-1 text-[11px] text-muted-foreground">
                        <IndentIncrease className="w-3 h-3" />{req}
                      </span>
                    </div>
                  </div>
                </div>
              ))}
              <Link to="/enrollment">
                <button className="w-full text-xs text-primary hover:underline flex items-center justify-center gap-1 pt-2">
                  See all open positions <ChevronRight className="w-3 h-3" />
                </button>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* ── Marketer Opportunities ── */}
      <section id="marketers" className="py-20">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="text-center mb-12">
            <Badge className="bg-accent/10 text-accent border-accent/20 mb-4">Marketer Programme</Badge>
            <h2 className="text-3xl md:text-4xl font-bold font-[Manrope] mb-3 text-balance">
              Earn Money Completing Service Jobs
            </h2>
            <p className="text-muted-foreground max-w-xl mx-auto">
              Every time a user pays for a service, a job is auto-created for marketers. Claim it, complete it in 10 minutes, and earn your commission — all from your phone.
            </p>
          </div>

          <div className="grid md:grid-cols-2 gap-8 items-center mb-12">
            <div className="grid grid-cols-2 gap-4">
              {MARKETER_BENEFITS.map(({ icon: Icon, title, desc }) => (
                <div key={title} className="bg-card border border-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                  <div className="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center mb-3">
                    <Icon className="w-4 h-4 text-primary" />
                  </div>
                  <p className="font-semibold text-sm mb-1">{title}</p>
                  <p className="text-xs text-muted-foreground leading-relaxed">{desc}</p>
                </div>
              ))}
            </div>

            <div className="bg-card border border-primary/20 rounded-2xl p-7 relative overflow-hidden">
              <div className="absolute top-0 right-0 w-48 h-48 rounded-full bg-primary/8 blur-[60px] pointer-events-none" />
              <div className="relative z-10">
                <p className="text-xs font-semibold text-primary mb-4 uppercase tracking-wider">How It Works</p>
                {[
                  { step: '1', title: 'Register as Marketer', desc: 'Sign up with your NIN, BVN, shop info and photos. AI verifies everything automatically.' },
                  { step: '2', title: 'Wait for Job Alert', desc: 'A user pays for a service → a job is instantly created and shown in your dashboard.' },
                  { step: '3', title: 'Claim & Complete', desc: 'Claim the job. You have 10 minutes. Submit proof. Get paid to your bank account.' },
                ].map(({ step, title, desc }) => (
                  <div key={step} className="flex gap-4 mb-5 last:mb-0">
                    <div className="w-7 h-7 rounded-full bg-primary flex items-center justify-center text-primary-foreground text-xs font-bold shrink-0 mt-0.5">
                      {step}
                    </div>
                    <div>
                      <p className="font-semibold text-sm mb-0.5">{title}</p>
                      <p className="text-xs text-muted-foreground leading-relaxed">{desc}</p>
                    </div>
                  </div>
                ))}
                <Link to="/marketer/register" className="mt-6 block">
                  <Button className="w-full gap-2">
                    <Briefcase className="w-4 h-4" /> Register as Marketer
                  </Button>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── API Section ── */}
      <section id="api" className="py-20 border-y border-border bg-muted/20">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="grid md:grid-cols-2 gap-12 items-center">
            {/* Left: code preview */}
            <div className="bg-[hsl(220,18%,10%)] border border-border rounded-2xl overflow-hidden shadow-2xl">
              <div className="flex items-center gap-2 px-4 py-3 border-b border-border/40">
                <div className="w-3 h-3 rounded-full bg-destructive/60" />
                <div className="w-3 h-3 rounded-full bg-warning/60" />
                <div className="w-3 h-3 rounded-full bg-success/60" />
                <span className="ml-2 text-xs text-muted-foreground font-mono">IMTechPay API — airtime.js</span>
              </div>
              <div className="p-5 font-mono text-sm">
                <div className="text-muted-foreground/60 text-xs mb-3">// Purchase airtime via REST API</div>
                {[
                  { t: 'keyword', v: 'const ' },{ t: 'var', v: 'response ' },{ t: 'op', v: '= ' },{ t: 'keyword', v: 'await ' },{ t: 'fn', v: 'fetch' },{ t: 'base', v: '(' },
                ].map((_) => null)}
                <pre className="text-[13px] leading-relaxed overflow-x-auto text-left">
                  <span className="text-blue-400">const </span>
                  <span className="text-foreground">res </span>
                  <span className="text-blue-400">= await </span>
                  <span className="text-yellow-300">fetch</span>
                  <span className="text-foreground">(</span>
                  <span className="text-green-400">{`'https://api.imtechpay.com/v1/airtime'`}</span>
                  <span className="text-foreground">, {'{'}</span>{'\n'}
                  <span className="text-foreground">  method: </span>
                  <span className="text-green-400">'POST'</span>
                  <span className="text-foreground">,</span>{'\n'}
                  <span className="text-foreground">  headers: {'{'}</span>{'\n'}
                  <span className="text-foreground">    </span>
                  <span className="text-green-400">'Authorization'</span>
                  <span className="text-foreground">: </span>
                  <span className="text-orange-300">`Bearer ${'{'}</span>
                  <span className="text-blue-300">SECRET_KEY</span>
                  <span className="text-orange-300">{'}'}`</span>
                  <span className="text-foreground">,</span>{'\n'}
                  <span className="text-foreground">    </span>
                  <span className="text-green-400">'X-Public-Key'</span>
                  <span className="text-foreground">: PUBLIC_KEY</span>{'\n'}
                  <span className="text-foreground">  {'}'},</span>{'\n'}
                  <span className="text-foreground">  body: </span>
                  <span className="text-yellow-300">JSON.stringify</span>
                  <span className="text-foreground">({'{'}</span>{'\n'}
                  <span className="text-foreground">    phone: </span>
                  <span className="text-green-400">'09035777781'</span>
                  <span className="text-foreground">, amount: </span>
                  <span className="text-purple-400">500</span>
                  <span className="text-foreground">, network: </span>
                  <span className="text-green-400">'mtn'</span>{'\n'}
                  <span className="text-foreground">  {'}'})</span>{'\n'}
                  <span className="text-foreground">{'}'});</span>
                </pre>
              </div>

              {/* Endpoint list */}
              <div className="border-t border-border/40 px-5 py-4 space-y-2">
                {API_ENDPOINTS.map(({ method, path, desc }) => (
                  <div key={path} className="flex items-center gap-3 text-xs">
                    <span className={cn('font-mono font-bold w-10 shrink-0', method === 'GET' ? 'text-success' : 'text-primary')}>{method}</span>
                    <span className="font-mono text-muted-foreground flex-1 truncate">{path}</span>
                    <span className="text-muted-foreground/60 hidden md:block truncate">{desc}</span>
                  </div>
                ))}
              </div>
            </div>

            {/* Right: copy */}
            <div>
              <Badge className="bg-primary/10 text-primary border-primary/20 mb-4">Developer API</Badge>
              <h2 className="text-3xl md:text-4xl font-bold font-[Manrope] mb-4 text-balance">
                Build Your Own VTU Business
              </h2>
              <p className="text-muted-foreground leading-relaxed mb-6">
                IMTechPay's REST API gives Tier 3 users full programmatic access to all services — airtime, data, bills, NIN/BVN, and more. Build white-label apps, automate transactions, and scale your business.
              </p>

              <div className="space-y-3 mb-7">
                {[
                  { icon: Key, label: 'Public + Secret Key Pair', desc: 'Generate keys instantly from your Tier 3 dashboard. Reset anytime.' },
                  { icon: Layers, label: 'Multi-Provider Failover', desc: 'Your API calls auto-route through redundant providers — no manual handling.' },
                  { icon: Terminal, label: 'Full Documentation', desc: 'Interactive docs, code examples in JS, Python, PHP, and cURL.' },
                ].map(({ icon: Icon, label, desc }) => (
                  <div key={label} className="flex gap-3">
                    <div className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0 mt-0.5">
                      <Icon className="w-4 h-4 text-primary" />
                    </div>
                    <div>
                      <p className="text-sm font-semibold">{label}</p>
                      <p className="text-xs text-muted-foreground">{desc}</p>
                    </div>
                  </div>
                ))}
              </div>

              <div className="flex flex-wrap gap-3">
                <Link to="/api-docs">
                  <Button size="lg" className="gap-2 h-11">
                    <ExternalLink className="w-4 h-4" /> View API Docs
                  </Button>
                </Link>
                <Link to="/register">
                  <Button size="lg" variant="outline" className="gap-2 h-11">
                    Get API Keys (Tier 3)
                  </Button>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── Features ── */}
      <section id="features" className="py-20 bg-muted/20 border-y border-border">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="text-center mb-12">
            <Badge className="bg-primary/10 text-primary border-primary/20 mb-4">Why IMTechPay</Badge>
            <h2 className="text-3xl md:text-4xl font-bold font-[Manrope] mb-3 text-balance">
              Built for Speed, Security & Scale
            </h2>
            <p className="text-muted-foreground max-w-xl mx-auto">
              Enterprise-grade technology wrapped in a simple, beautiful interface for everyday Nigerians.
            </p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            {FEATURES.map(({ icon: Icon, title, desc }) => (
              <div key={title} className="bg-card border border-border rounded-2xl p-6 hover:border-primary/30 transition-colors">
                <div className="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mb-4">
                  <Icon className="w-5 h-5 text-primary" />
                </div>
                <h3 className="font-semibold text-sm mb-2">{title}</h3>
                <p className="text-xs text-muted-foreground leading-relaxed">{desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── Tiers ── */}
      <section id="tiers" className="py-20">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="text-center mb-12">
            <Badge className="bg-primary/10 text-primary border-primary/20 mb-4">Account Tiers</Badge>
            <h2 className="text-3xl md:text-4xl font-bold font-[Manrope] mb-3 text-balance">
              Grow With Every Transaction
            </h2>
            <p className="text-muted-foreground max-w-xl mx-auto">
              Start free and unlock higher limits, virtual accounts, and business features as you grow.
            </p>
          </div>

          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {TIERS.map(t => (
              <div key={t.tier}
                className={cn(
                  'relative bg-card border-2 rounded-2xl p-6 transition-all duration-200 flex flex-col',
                  t.color,
                  t.highlight && 'shadow-xl shadow-primary/10'
                )}>
                {t.highlight && (
                  <div className="absolute -top-3 left-1/2 -translate-x-1/2">
                    <Badge className="bg-primary text-primary-foreground px-3 py-0.5 text-xs font-semibold flex items-center gap-1">
                      <Award className="w-3 h-3" /> Most Popular
                    </Badge>
                  </div>
                )}
                <div className="flex items-center gap-2 mb-1">
                  <span className={cn('text-xs font-bold px-2 py-0.5 rounded-full', t.badge)}>Tier {t.tier}</span>
                </div>
                <p className="font-bold text-base mt-2">{t.label}</p>
                <p className="text-2xl font-extrabold text-primary font-[Manrope] mt-1 mb-4">{t.limit}<span className="text-xs font-normal text-muted-foreground">/day</span></p>
                <ul className="space-y-2 flex-1">
                  {t.perks.map(p => (
                    <li key={p} className="flex items-center gap-2 text-xs text-muted-foreground">
                      <CheckCircle2 className="w-3.5 h-3.5 text-primary shrink-0" />{p}
                    </li>
                  ))}
                </ul>
                <Link to="/register" className="mt-5 block">
                  <Button size="sm" className="w-full h-9 text-xs" variant={t.highlight ? 'default' : 'outline'}>
                    Get Started
                  </Button>
                </Link>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── Testimonials ── */}
      <section className="py-20 bg-muted/20 border-y border-border">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="text-center mb-12">
            <Badge className="bg-primary/10 text-primary border-primary/20 mb-4">Testimonials</Badge>
            <h2 className="text-3xl font-bold font-[Manrope] mb-3 text-balance">Trusted by Nigerians</h2>
          </div>
          <div className="grid md:grid-cols-3 gap-5">
            {TESTIMONIALS.map((t) => (
              <div key={t.name} className="bg-card border border-border rounded-2xl p-6">
                <div className="flex gap-0.5 mb-3">
                  {Array.from({ length: 5 }).map((_, i) => (
                    <Star key={i} className="w-4 h-4 fill-primary text-primary" />
                  ))}
                </div>
                <p className="text-sm text-muted-foreground leading-relaxed mb-4">"{t.text}"</p>
                <div>
                  <p className="font-semibold text-sm">{t.name}</p>
                  <p className="text-xs text-muted-foreground">{t.role}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── Promo Winners ── */}
      <PromoWinnersSection />

      {/* ── CTA ── */}
      <section id="about" className="py-20">
        <div className="max-w-3xl mx-auto px-4 md:px-8 text-center">
          <div className="bg-card border border-primary/20 rounded-3xl p-10 md:p-14 relative overflow-hidden">
            {/* background glow */}
            <div className="absolute inset-0 pointer-events-none">
              <div className="absolute top-0 left-1/2 -translate-x-1/2 w-80 h-40 rounded-full bg-primary/15 blur-[80px]" />
            </div>
            <div className="relative z-10">
              <img src={LOGO} alt="IMTechPay" className="w-16 h-16 object-contain mx-auto mb-4" />
              <h2 className="text-3xl md:text-4xl font-extrabold font-[Manrope] mb-3 text-balance">
                Start Transacting in Seconds
              </h2>
              <p className="text-muted-foreground mb-7 max-w-md mx-auto">
                Join over 200,000 users who trust IMTechPay for their daily financial transactions. Free to join, instant setup.
              </p>
              <div className="flex flex-col sm:flex-row gap-3 justify-center">
                <Link to="/register">
                  <Button size="lg" className="h-12 px-8 text-base font-semibold gap-2">
                    Create Free Account <ArrowRight className="w-4 h-4" />
                  </Button>
                </Link>
                <Link to="/login">
                  <Button size="lg" variant="outline" className="h-12 px-8 text-base gap-2">
                    <Lock className="w-4 h-4" /> Sign In
                  </Button>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── Footer ── */}
      <footer className="border-t border-border bg-muted/10 py-10">
        <div className="max-w-7xl mx-auto px-4 md:px-8">
          <div className="grid md:grid-cols-4 gap-8 mb-8">
            <div>
              <div className="flex items-center gap-2 mb-3">
                <img src={LOGO} alt="IMTechPay" className="w-8 h-8 object-contain" />
                <span className="font-bold text-sm font-[Manrope]">IMTechPay</span>
              </div>
              <p className="text-xs text-muted-foreground leading-relaxed">
                Nigeria's most trusted VTU and bill payment platform. Fast, secure, and always available.
              </p>
            </div>
            <div>
              <p className="font-semibold text-xs mb-3">Services</p>
              <ul className="space-y-1.5 text-xs text-muted-foreground">
                {['Airtime & Data', 'Electricity', 'Cable TV', 'Internet/WiFi', 'Cafe Services'].map(s => (
                  <li key={s}><Link to="/register" className="hover:text-primary transition-colors">{s}</Link></li>
                ))}
              </ul>
            </div>
            <div>
              <p className="font-semibold text-xs mb-3">Platform</p>
              <ul className="space-y-1.5 text-xs text-muted-foreground">
                {[
                  { label: 'User Login', to: '/login' },
                  { label: 'Register', to: '/register' },
                  { label: 'Marketer Portal', to: '/marketer' },
                  { label: 'Enrollment', to: '/enrollment' },
                  { label: 'API Docs', to: '/api-docs' },
                ].map(l => (
                  <li key={l.label}><Link to={l.to} className="hover:text-primary transition-colors">{l.label}</Link></li>
                ))}
              </ul>
            </div>
            <div>
              <p className="font-semibold text-xs mb-3">Opportunities</p>
              <ul className="space-y-1.5 text-xs text-muted-foreground">
                {[
                  { label: 'Open Positions', to: '/enrollment' },
                  { label: 'Become a Marketer', to: '/marketer/register' },
                  { label: 'API Access (Tier 3)', to: '/register' },
                  { label: 'White-Label Platform', to: '/register' },
                ].map(l => (
                  <li key={l.label}><Link to={l.to} className="hover:text-primary transition-colors">{l.label}</Link></li>
                ))}
              </ul>
            </div>
            <div>
              <p className="font-semibold text-xs mb-3">Contact</p>
              <ul className="space-y-1.5 text-xs text-muted-foreground">
                <li><a href="mailto:support@imtechpay.com?subject=IMTechPay%20Inquiry&body=Hello%20IMTechPay%20team%2C%0A%0AI%20would%20like%20to%20know%20more%20about%20..." className="hover:text-primary transition-colors">support@imtechpay.com</a></li>
                <li><a href="tel:+2349035777781" className="hover:text-primary transition-colors">+234 9035 7777 81</a></li>
                <li><a href="https://wa.me/2349035777781?text=Hello%20IMTechPay%2C%20I%20would%20like%20to%20..." target="_blank" rel="noreferrer" className="hover:text-primary transition-colors">WhatsApp: 09035777781</a></li>
                <li>Kabuga, Kano State</li>
              </ul>
            </div>
          </div>
          <div className="border-t border-border pt-5 flex flex-col md:flex-row items-center justify-between gap-2 text-xs text-muted-foreground">
            <p>© {new Date().getFullYear()} IMTechPay Nigeria Limited. All rights reserved.</p>
            <div className="flex items-center gap-1">
              <Lock className="w-3 h-3" />
              <span>SSL Secured · Powered by CBN-licensed Payment Partners</span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
}
