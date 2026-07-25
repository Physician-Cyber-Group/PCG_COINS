import Home from './pages/Home';
import Register from './pages/Register';
import Login from './pages/Login';
import MarketerPortal from './pages/MarketerPortal';
import MarketerRegister from './pages/MarketerRegister';
import MarketerLogin from './pages/MarketerLogin';
import Enrollment from './pages/Enrollment';
import ApiDocs from './pages/ApiDocs';
import type { ReactNode } from 'react';

export interface RouteConfig {
  name: string;
  path: string;
  element: ReactNode;
  visible?: boolean;
  /** Accessible without login. Routes without this flag require authentication. Has no effect when RouteGuard is not in use. */
  public?: boolean;
}

export const routes: RouteConfig[] = [
  {
    name: 'Home',
    path: '/',
    element: <Home />,
    public: true,
  },
  {
    name: 'Register',
    path: '/register',
    element: <Register />,
    public: true,
  },
  {
    name: 'Log In',
    path: '/login',
    element: <Login />,
    public: true,
  },
  {
    name: 'Marketer Portal',
    path: '/marketer',
    element: <MarketerPortal />,
    public: true,
  },
  {
    name: 'Marketer Register',
    path: '/marketer/register',
    element: <MarketerRegister />,
    public: true,
  },
  {
    name: 'Marketer Login',
    path: '/marketer/login',
    element: <MarketerLogin />,
    public: true,
  },
  {
    name: 'Enrollment',
    path: '/enrollment',
    element: <Enrollment />,
    public: true,
  },
  {
    name: 'API Docs',
    path: '/api-docs',
    element: <ApiDocs />,
    public: true,
  },
];
