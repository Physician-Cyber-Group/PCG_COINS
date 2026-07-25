import { useEffect } from 'react';
import { useLocation } from 'react-router-dom';
import { useOverlay } from '@/contexts/OverlayContext';

export function RouteChangeLoader() {
  const location = useLocation();
  const { show, hide } = useOverlay();

  useEffect(() => {
    show();
    const timer = setTimeout(() => {
      hide();
    }, 220);

    return () => clearTimeout(timer);
    // Only re-run when pathname changes
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [location.pathname]);

  return null;
}