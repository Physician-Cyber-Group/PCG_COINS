import React, { useState } from 'react';
import { Eye, EyeOff, Delete } from 'lucide-react';
import { cn } from '@/lib/utils';

interface CustomKeypadProps {
  value: string;
  onChange: (val: string) => void;
  maxLength?: number;
  label?: string;
  className?: string;
}

const KEYS = ['1','2','3','4','5','6','7','8','9','','0','⌫'];

export function CustomKeypad({ value, onChange, maxLength = 6, label, className }: CustomKeypadProps) {
  const [visible, setVisible] = useState(false);

  const handleKey = (k: string) => {
    if (k === '⌫') {
      onChange(value.slice(0, -1));
    } else if (k === '') {
      return;
    } else if (value.length < maxLength) {
      onChange(value + k);
    }
  };

  return (
    <div className={cn('flex flex-col items-center gap-4', className)}>
      {label && <p className="text-sm text-muted-foreground font-medium">{label}</p>}

      {/* Display dots */}
      <div className="flex items-center gap-3">
        {Array.from({ length: maxLength }).map((_, i) => {
          const filled = i < value.length;
          return (
            <div
              key={i}
              className={cn(
                'w-4 h-4 rounded-full border-2 transition-all duration-150',
                filled
                  ? 'bg-primary border-primary'
                  : 'bg-transparent border-muted-foreground/50'
              )}
            />
          );
        })}
        <button
          type="button"
          onClick={() => setVisible(v => !v)}
          className="ml-2 text-muted-foreground hover:text-foreground transition-colors"
        >
          {visible ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
        </button>
      </div>

      {visible && value && (
        <p className="text-sm font-mono tracking-widest text-primary">{value}</p>
      )}

      {/* Keypad grid */}
      <div className="grid grid-cols-3 gap-3 w-full max-w-xs">
        {KEYS.map((k, i) => (
          <button
            key={i}
            type="button"
            onClick={() => handleKey(k)}
            disabled={k === ''}
            className={cn(
              'h-14 rounded-md text-xl font-semibold transition-all duration-75 select-none',
              k === '' && 'opacity-0 pointer-events-none',
              k === '⌫'
                ? 'bg-muted text-foreground hover:bg-muted/80 active:scale-95 flex items-center justify-center'
                : 'bg-muted text-foreground hover:bg-primary/20 hover:text-primary active:scale-95 border border-border'
            )}
          >
            {k === '⌫' ? <Delete className="w-5 h-5 mx-auto" /> : k}
          </button>
        ))}
      </div>
    </div>
  );
}
