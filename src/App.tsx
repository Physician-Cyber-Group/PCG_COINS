import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { Toaster } from '@/components/ui/sonner';
import { ThemeProvider } from '@/components/theme-provider';
import { OverlayProvider, useOverlay } from '@/contexts/OverlayContext';
import { PageLoader } from '@/components/ui/page-loader';
import { RouteChangeLoader } from '@/components/RouteChangeLoader';

import { routes } from './routes';

function GlobalLoader() {
  const { visible } = useOverlay();
  return <PageLoader visible={visible} />;
}

const App: React.FC = () => {
  return (
    <Router>
      <ThemeProvider defaultTheme="dark" storageKey="imtechpay-ui-theme">
        <OverlayProvider>
          <GlobalLoader />
          <RouteChangeLoader />
          <Routes>
            {routes.map((route, index) => (
              <Route key={index} path={route.path} element={route.element} />
            ))}
            <Route path="*" element={<Navigate to="/" replace />} />
          </Routes>
          <Toaster />
        </OverlayProvider>
      </ThemeProvider>
    </Router>
  );
};

export default App;
