import { cn } from '@/lib/utils';

const LOGO = 'https://miaoda-conversation-file.s3cdn.medo.dev/user-d8no6jsrey9s/app-d8noh2mwr30h/20260724/logo.png';

interface PageLoaderProps {
  visible: boolean;
}

export function PageLoader({ visible }: PageLoaderProps) {
  return (
    <div
      className={cn(
        'fixed inset-0 z-[100] flex flex-col items-center justify-center transition-all duration-700 ease-in-out',
        visible ? 'opacity-100 visible' : 'opacity-0 invisible pointer-events-none'
      )}
      aria-busy={visible}
      aria-live="polite"
    >
      <div className="absolute inset-0 bg-white/80 dark:bg-background/80 backdrop-blur-md" />

      <div className="relative z-10 flex flex-col items-center">
        <div className="relative flex items-center justify-center w-32 h-32 mb-8">
          <div className="absolute inset-0 rounded-full border-4 border-[#00C788]/20" />
          <div className="absolute inset-0 rounded-full border-4 border-transparent border-t-[#00C788] border-r-[#00C788] animate-spin" style={{ animationDuration: '1.1s' }} />
          <div className="absolute inset-1.5 rounded-full border-4 border-transparent border-b-[#00C788] border-l-[#00C788]/60 animate-spin" style={{ animationDuration: '1.6s', animationDirection: 'reverse' }} />
          <div className="animate-breathe flex items-center justify-center w-20 h-20 rounded-full bg-white dark:bg-card shadow-sm p-3">
            <img src={LOGO} alt="IMTech" className="w-full h-full object-contain" />
          </div>
        </div>

        <p className="text-lg font-semibold text-foreground tracking-tight">IMTechPay</p>
        <p className="mt-2 text-sm text-muted-foreground font-medium">Loading your experience…</p>
      </div>
    </div>
  );
}
