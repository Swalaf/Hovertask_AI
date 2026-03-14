import Echo from "laravel-echo";
import Pusher from "pusher-js";

// Check if app key is available
const appKey = import.meta.env.VITE_REVERB_APP_KEY;

// Initialize Pusher globally if app key exists
if (appKey) {
    window.Pusher = Pusher;
}

export const echo = appKey ? new Echo({
    broadcaster: "reverb",
    key: appKey,
    wsHost: import.meta.env.VITE_REVERB_HOST || window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT || 8080,
    wssPort: import.meta.env.VITE_REVERB_PORT || 8080,
    wsPath: "/reverb",
    forceTLS: false,
    scheme: import.meta.env.VITE_REVERB_SCHEME || "http",
    enabledTransports: ["ws", "wss"],
}) : null;
