import { Link, useLocation } from 'react-router-dom';
import { Button } from '@/components/ui/button';
import { ThemeToggle } from '@/components/theme-toggle';
import { Phone, Mail, MessageCircle} from 'lucide-react';

const LOGO = 'https://miaoda-conversation-file.s3cdn.medo.dev/user-d8no6jsrey9s/app-d8noh2mwr30h/20260724/logo.png';

interface PortalShellProps {
  children: React.ReactNode;
  title?: string;
  subtitle?: string;
}

export function PortalShell({ children, title, subtitle }: PortalShellProps) {
  const location = useLocation();
  const isActive = (path: string) => location.pathname === path;

  const links = [
    { to: '/', label: 'Home' },
    { to: '/register', label: 'Register' },
    { to: '/login', label: 'Login' },
    { to: '/marketer', label: 'Marketer' },
  ];

  return (
    <div className="min-h-screen flex flex-col bg-background text-foreground">
      <header className="sticky top-0 z-40 w-full border-b bg-background/95 backdrop-blur">
        <div className="container flex h-16 items-center justify-between px-4">
          <Link to="/" className="flex items-center gap-2">
            <img src={LOGO} alt="IMTechPay" className="h-10 w-auto" />
            <span className="font-bold text-lg tracking-tight">IMTechPay</span>
          </Link>
          <nav className="hidden md:flex items-center gap-1">
            {links.map((link) => (
              <Button
                key={link.to}
                variant={isActive(link.to) ? 'default' : 'ghost'}
                size="sm"
                asChild
              >
                <Link to={link.to}>{link.label}</Link>
              </Button>
            ))}
          </nav>
          <div className="flex items-center gap-2">
            <ThemeToggle />
          </div>
        </div>
      </header>

      {title && (
        <section className="bg-muted/40 border-b py-12 md:py-16">
          <div className="container px-4 text-center">
            <h1 className="text-2xl md:text-4xl font-bold tracking-tight mb-3">{title}</h1>
            {subtitle && <p className="text-muted-foreground max-w-2xl mx-auto">{subtitle}</p>}
          </div>
        </section>
      )}

      <main className="flex-1">{children}</main>

      <footer className="border-t bg-muted/30 py-10">
        <div className="container px-4">
          <div className="flex flex-col md:flex-row items-center justify-between gap-6">
            <div className="flex items-center gap-2">
              <img src={LOGO} alt="IMTechPay" className="h-8 w-auto" />
              <span className="font-semibold">IMTechPay</span>
            </div>
            <div className="flex flex-wrap items-center justify-center gap-4 text-sm text-muted-foreground">
              <a href="tel:+2349035777781" className="flex items-center gap-1.5 hover:text-primary transition-colors">
                <Phone className="w-4 h-4" /> 09035777781
              </a>
              <a href="mailto:support@imtechpay.com?subject=IMTechPay%20Inquiry&body=Hello%20IMTechPay%20team%2C%0A%0AI%20would%20like%20to%20know%20more%20about%20..." className="flex items-center gap-1.5 hover:text-primary transition-colors">
                <Mail className="w-4 h-4" /> support@imtechpay.com
              </a>
              <a href="https://wa.me/2349035777781?text=Hello%20IMTechPay%2C%20I%20would%20like%20to%20..." target="_blank" rel="noreferrer" className="flex items-center gap-1.5 hover:text-primary transition-colors">
                <MessageCircle className="w-4 h-4" /> WhatsApp
              </a>
            </div>
            <p className="text-xs text-muted-foreground">© {new Date().getFullYear()} IMTechPay. All rights reserved.</p>
          </div>
        </div>
      </footer>
    </div>
  );
}
