import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { PortalShell } from '@/components/layouts/PortalShell';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Terminal, Key, Shield, Copy, CheckCircle2 } from 'lucide-react';
import { useState } from 'react';
import { toast } from 'sonner';

const BASE_URL = 'https://api.imtechpay.com/v1';

const ENDPOINTS = [
  {
    method: 'POST',
    path: '/auth/login',
    desc: 'Authenticate a user and retrieve a session token.',
    body: JSON.stringify({ identifier: '09035777781', password: 'your_password' }, null, 2),
  },
  {
    method: 'POST',
    path: '/wallet/fund',
    desc: 'Initiate a wallet funding transaction.',
    body: JSON.stringify({ amount: 5000, channel: 'bank_transfer' }, null, 2),
  },
  {
    method: 'POST',
    path: '/airtime/purchase',
    desc: 'Purchase airtime for any Nigerian mobile network.',
    body: JSON.stringify({ network: 'mtn', phone: '09035777781', amount: 500 }, null, 2),
  },
  {
    method: 'GET',
    path: '/transactions',
    desc: 'List recent transactions for the authenticated user.',
    body: '',
  },
];

export default function ApiDocs() {
  const [copied, setCopied] = useState<string | null>(null);

  const copy = (text: string, key: string) => {
    navigator.clipboard.writeText(text);
    setCopied(key);
    setTimeout(() => setCopied(null), 1500);
  };

  return (
    <PortalShell
      title="API Documentation"
      subtitle="Build your own VTU, wallet, and payment experiences on the IMTechPay platform."
    >
      <div className="container px-4 py-10 md:py-16">
        <div className="grid lg:grid-cols-4 gap-8 mb-12">
          <Card className="border bg-card/60 lg:col-span-1">
            <CardContent className="p-6 space-y-4">
              <div className="flex items-center gap-2 text-primary">
                <Key className="w-5 h-5" />
                <span className="font-semibold">Quick Start</span>
              </div>
              <ol className="space-y-3 text-sm text-muted-foreground list-decimal pl-4">
                <li>Create a Tier 3 account</li>
                <li>Generate an API key from your dashboard</li>
                <li>Add the key to your request headers</li>
                <li>Use sandbox mode to test integrations</li>
              </ol>
              <Button className="w-full" variant="outline" onClick={() => toast.info('API access request demo. Contact support@imtechpay.com.')}>Request API Access</Button>
            </CardContent>
          </Card>

          <div className="lg:col-span-3 space-y-6">
            <div>
              <Badge className="mb-3 bg-success/15 text-success border-success/30">Sandbox Available</Badge>
              <h2 className="text-2xl font-bold mb-3">Base URL</h2>
              <div className="flex items-center justify-between bg-muted/50 border rounded-lg px-4 py-3">
                <code className="text-sm font-mono">{BASE_URL}</code>
                <Button variant="ghost" size="icon" onClick={() => copy(BASE_URL, 'base')}>
                  {copied === 'base' ? <CheckCircle2 className="w-4 h-4 text-success" /> : <Copy className="w-4 h-4" />}
                </Button>
              </div>
            </div>

            <Tabs defaultValue="endpoints" className="w-full">
              <TabsList>
                <TabsTrigger value="endpoints">Endpoints</TabsTrigger>
                <TabsTrigger value="auth">Authentication</TabsTrigger>
                <TabsTrigger value="errors">Errors</TabsTrigger>
              </TabsList>
              <TabsContent value="endpoints" className="space-y-4 mt-4">
                {ENDPOINTS.map((ep) => (
                  <Card key={ep.path} className="border bg-card/60">
                    <CardHeader className="pb-3">
                      <div className="flex flex-wrap items-center gap-2 mb-1">
                        <Badge className={ep.method === 'GET' ? 'bg-info/15 text-info border-info/30' : 'bg-warning/15 text-warning border-warning/30'}>
                          {ep.method}
                        </Badge>
                        <code className="text-sm font-mono">{ep.path}</code>
                      </div>
                      <CardTitle className="text-base font-medium">{ep.desc}</CardTitle>
                    </CardHeader>
                    {ep.body && (
                      <CardContent>
                        <p className="text-xs text-muted-foreground mb-2 uppercase tracking-wide">Example body</p>
                        <pre className="bg-muted/50 border rounded-lg p-4 text-xs font-mono overflow-x-auto">{ep.body}</pre>
                      </CardContent>
                    )}
                  </Card>
                ))}
              </TabsContent>
              <TabsContent value="auth" className="mt-4">
                <Card className="border bg-card/60">
                  <CardContent className="p-6">
                    <div className="flex items-center gap-2 mb-3 text-primary">
                      <Shield className="w-5 h-5" /> <span className="font-semibold">Bearer Token</span>
                    </div>
                    <p className="text-sm text-muted-foreground mb-4">
                      Include your API key in the Authorization header for every request.
                    </p>
                    <pre className="bg-muted/50 border rounded-lg p-4 text-xs font-mono overflow-x-auto">
                      {`Authorization: Bearer YOUR_API_KEY\nContent-Type: application/json`}
                    </pre>
                  </CardContent>
                </Card>
              </TabsContent>
              <TabsContent value="errors" className="mt-4">
                <Card className="border bg-card/60">
                  <CardContent className="p-6">
                    <p className="text-sm text-muted-foreground mb-4">Standard HTTP status codes are used with a JSON error body.</p>
                    <ul className="space-y-2 text-sm">
                      <li><code className="bg-muted px-1.5 py-0.5 rounded text-xs">400</code> Bad Request — validation failed</li>
                      <li><code className="bg-muted px-1.5 py-0.5 rounded text-xs">401</code> Unauthorized — invalid or missing key</li>
                      <li><code className="bg-muted px-1.5 py-0.5 rounded text-xs">404</code> Not Found — resource does not exist</li>
                      <li><code className="bg-muted px-1.5 py-0.5 rounded text-xs">429</code> Too Many Requests — rate limit exceeded</li>
                    </ul>
                  </CardContent>
                </Card>
              </TabsContent>
            </Tabs>
          </div>
        </div>

        <Card className="border bg-primary/5">
          <CardContent className="p-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div className="flex items-center gap-3">
              <Terminal className="w-8 h-8 text-primary" />
              <div>
                <h3 className="font-semibold">Ready to integrate?</h3>
                <p className="text-sm text-muted-foreground">Contact our engineering team for sandbox credentials and integration support.</p>
              </div>
            </div>
            <Button variant="outline" onClick={() => toast.info('Demo: contact support@imtechpay.com for integration help.')}>Contact Engineering</Button>
          </CardContent>
        </Card>
      </div>
    </PortalShell>
  );
}
