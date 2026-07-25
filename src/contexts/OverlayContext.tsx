import { createContext, useContext, useEffect, useRef, useState, type ReactNode } from 'react';

interface OverlayContextValue {
  show: () => void;
  hide: () => void;
  visible: boolean;
}

const OverlayContext = createContext<OverlayContextValue | null>(null);

export function useOverlay() {
  const ctx = useContext(OverlayContext);
  if (!ctx) throw new Error('useOverlay must be used within OverlayProvider');
  return ctx;
}

interface OverlayProviderProps {
  children: ReactNode;
}

export function OverlayProvider({ children }: OverlayProviderProps) {
  const [visible, setVisible] = useState(false);
  const requestCount = useRef(0);

  const show = () => {
    requestCount.current += 1;
    setVisible(true);
  };

  const hide = () => {
    requestCount.current = Math.max(0, requestCount.current - 1);
    if (requestCount.current === 0) {
      setVisible(false);
    }
  };

  useEffect(() => {
    const markReady = () => {
      setTimeout(() => hide(), 150);
    };

    if (document.readyState === 'complete' || document.readyState === 'interactive') {
      markReady();
    } else {
      document.addEventListener('DOMContentLoaded', markReady);
      window.addEventListener('load', markReady);
    }

    const handleSubmit = (event: SubmitEvent) => {
      const target = event.target as HTMLElement;
      if (target?.closest('form')) {
        show();
        setTimeout(() => hide(), 700);
      }
    };

    document.addEventListener('submit', handleSubmit, true);

    const originalFetch = window.fetch;
    window.fetch = async (...args) => {
      show();
      try {
        const response = await originalFetch(...args);
        return response;
      } finally {
        hide();
      }
    };

    return () => {
      document.removeEventListener('DOMContentLoaded', markReady);
      window.removeEventListener('load', markReady);
      document.removeEventListener('submit', handleSubmit, true);
      window.fetch = originalFetch;
    };
  }, []);

  return (
    <OverlayContext.Provider value={{ show, hide, visible }}>
      {children}
    </OverlayContext.Provider>
  );
}
