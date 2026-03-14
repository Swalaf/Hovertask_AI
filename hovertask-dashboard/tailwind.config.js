import { heroui } from "@heroui/react";

/** @type {import('tailwindcss').Config} */
export default {
  content: ["./src/**/*.{jsx,tsx,js,ts}", "./index.html", "./node_modules/@heroui/theme/dist/**/*.{js,ts,jsx,tsx}"],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: "#4b70f5",
        "primary-light": "#6B8AFF",
        "primary-dark": "#3A5AE8",
        success: "#009a49",
        danger: "#ff5449",
        warning: "#F59E0B",
        secondary: "#000000BF",
        // Dark mode specific colors
        dark: {
          50: '#f8fafc',
          100: '#f1f5f9',
          200: '#e2e8f0',
          300: '#cbd5e1',
          400: '#94a3b8',
          500: '#64748b',
          600: '#475569',
          700: '#334155',
          800: '#1e293b',
          850: '#172033',
          900: '#0f172a',
          950: '#020617',
        }
      },
      boxShadow: {
        'card': '0 2px 8px rgba(0, 0, 0, 0.08)',
        'card-hover': '0 8px 24px rgba(0, 0, 0, 0.12)',
        'primary': '0 4px 14px 0 rgba(75, 112, 245, 0.3)',
        'primary-lg': '0 6px 20px rgba(75, 112, 245, 0.4)',
        // Dark mode shadows
        'dark': '0 4px 20px rgba(0, 0, 0, 0.4)',
        'dark-card': '0 2px 12px rgba(0, 0, 0, 0.3)',
        'dark-glow': '0 0 40px rgba(75, 112, 245, 0.15)',
      },
      screens: {
        mobile: "821px"
      },
      backgroundImage: {
        'dark-gradient': 'linear-gradient(to bottom, #0f172a, #1e293b)',
        'dark-gradient-radial': 'radial-gradient(ellipse at top, #1e293b 0%, #0f172a 100%)',
        'dark-card-gradient': 'linear-gradient(145deg, #1e293b 0%, #0f172a 100%)',
        'primary-glow': 'radial-gradient(circle at center, rgba(75, 112, 245, 0.2) 0%, transparent 70%)',
      }
    }
  },
  darkmode: true,
  plugins: [heroui()]
};
