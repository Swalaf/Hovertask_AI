import { echo } from "../lib/echo";
import { refreshUserApi } from "./updateUserApi";

export function listenForUserUpdates(userId: number) {
    // Skip if echo is not configured
    if (!echo) {
        console.log("[Realtime] Echo not configured, skipping real-time updates");
        return;
    }

    echo.channel(`user.${userId}`)
        .listen("wallet-updated", async () => {
            await refreshUserApi(); // 👈 re-fetch the API only
        });
}
