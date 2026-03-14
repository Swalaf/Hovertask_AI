import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { HelmetProvider } from "react-helmet-async";
import "./index.css";
import App from "./App.tsx";

// ============================================
// CACHE BUSTING & VERSION CONTROL SYSTEM
// ============================================

// App version - increment this on every deployment
const APP_VERSION = "2.0.0";

// Store version in localStorage for comparison
const STORAGE_KEYS = {
  APP_VERSION: "hovertask_app_version",
  FORCE_RELOAD: "hovertask_force_reload",
};

// Initialize version tracking - only in production builds
function initVersionControl() {
  // Skip version control in development
  if (import.meta.env.DEV) {
    console.log("[Cache Buster] Development mode - skipping version control");
    return true;
  }

  const storedVersion = localStorage.getItem(STORAGE_KEYS.APP_VERSION);
  const forceReload = localStorage.getItem(STORAGE_KEYS.FORCE_RELOAD);

  // If version mismatch or force reload needed, clear state and reload
  if (storedVersion !== APP_VERSION || forceReload === "true") {
    console.log(`[Cache Buster] Version changed: ${storedVersion} → ${APP_VERSION}`);

    // Clear all hovertask-related localStorage
    Object.keys(localStorage)
      .filter((key) => key.startsWith("hovertask_"))
      .forEach((key) => localStorage.removeItem(key));

    // Update version
    localStorage.setItem(STORAGE_KEYS.APP_VERSION, APP_VERSION);
    localStorage.removeItem(STORAGE_KEYS.FORCE_RELOAD);

    // Only reload if this isn't the first visit after version change
    if (storedVersion && storedVersion !== APP_VERSION) {
      console.log("[Cache Buster] Reloading to apply new version...");
      window.location.reload();
      return false;
    }
  }

  return true;
}

// Run version control before React mounts
const canMount = initVersionControl();

// Only mount if version check passed
if (canMount) {
  createRoot(document.getElementById("root")!).render(
    <StrictMode>
      <HelmetProvider>
        <App />
      </HelmetProvider>
    </StrictMode>
  );
}
