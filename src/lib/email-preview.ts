const LAUNCH_DATE = '5 August 2026 at 00:00 UTC';

function encodeMailtoBody(body: string): string {
  return encodeURIComponent(body).replace(/%20/g, ' ');
}

interface WelcomeEmailData {
  email: string;
  fullName: string;
  portal: string;
  phone: string;
  username?: string;
  referralCode?: string;
}

export function sendWelcomeEmailPreview(data: WelcomeEmailData): void {
  const subject = `Welcome to IMTechPay, ${data.fullName}!`;
  const body = `Hello ${data.fullName},

Welcome to IMTechPay — Nigeria's premier VTU and digital payments platform.

SIGN-UP DETAILS
• Portal: ${data.portal}
• Email: ${data.email}
• Phone: ${data.phone}
${data.username ? `• Username: ${data.username}\n` : ''}${data.referralCode ? `• Referral Code: ${data.referralCode}\n` : ''}
WHAT WE OFFER
• Instant airtime and data top-up for MTN, Airtel, Glo, and 9mobile
• Cheap data plans, bill payments, and cable TV subscriptions
• Secure wallet with bank transfer, card, and agency funding
• Tiered accounts with higher limits and API access (Tier 3)
• Marketer and enrollment programs to earn commissions

LAUNCH DATE
Our full platform launches on ${LAUNCH_DATE}. We will notify you as soon as all features go live.

If you have any questions, reply to this email or reach us on WhatsApp at 09035777781.

Thank you for joining IMTechPay.

Best regards,
The IMTechPay Team
https://imtechpay.com`;

  window.location.href = `mailto:${data.email}?subject=${encodeURIComponent(subject)}&body=${encodeMailtoBody(body)}`;
}

export function generateOtp(): string {
  return Math.floor(100000 + Math.random() * 900000).toString();
}

export function sendOtpEmailPreview(email: string, otp: string): void {
  const subject = 'Your IMTechPay Verification Code';
  const body = `Hello,

Your IMTechPay email verification code is:

${otp}

This code is valid for 2 minutes. If you did not request this code, please ignore this email.

Best regards,
The IMTechPay Team`;

  window.location.href = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeMailtoBody(body)}`;
}
