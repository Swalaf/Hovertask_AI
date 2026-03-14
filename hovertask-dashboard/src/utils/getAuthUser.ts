import apiEndpointBaseURL from "./apiEndpointBaseURL";

// ============================================
// IMPROVED AUTH USER FETCHER WITH CACHE FIX
// ============================================

// Cache with expiration to prevent stale data
interface CacheEntry {
  user: any;
  timestamp: number;
  tokenHash: string;
}

const CACHE_DURATION = 5 * 60 * 1000; // 5 minutes
let cachedUser: CacheEntry | null = null;

function getTokenHash(token: string): string {
  // Simple hash to detect token changes
  let hash = 0;
  for (let i = 0; i < token.length; i++) {
    const char = token.charCodeAt(i);
    hash = ((hash << 5) - hash) + char;
    hash = hash & hash;
  }
  return hash.toString();
}

function isCacheValid(token: string): boolean {
  if (!cachedUser) return false;
  
  const tokenHash = getTokenHash(token);
  const isExpired = Date.now() - cachedUser.timestamp > CACHE_DURATION;
  const isSameToken = cachedUser.tokenHash === tokenHash;
  
  return !isExpired && isSameToken;
}

export default async function getAuthUser() {
  let authToken = localStorage.getItem("auth_token");

  // 1️⃣ No token → clear cache and return null
  if (!authToken) {
    // Check for token in URL (first login)
    const urlToken = new URLSearchParams(window.location.search).get("token");

    if (urlToken) {
      authToken = urlToken;
      localStorage.setItem("auth_token", urlToken);

      // Clean URL (remove ?token=xxx)
      const cleanUrl = window.location.origin + window.location.pathname;
      window.history.replaceState({}, document.title, cleanUrl);
      console.log("[Auth] Token saved from URL, cleaned up URL");
      
      // Clear cache when new token is set
      cachedUser = null;
    } else {
      // No token at all - clear cache and return null
      cachedUser = null;
      console.log("[Auth] No auth token found, returning null");
      return null;
    }
  }

  // 2️⃣ Check if cache is valid for this token
  if (isCacheValid(authToken)) {
    console.log("[Auth] Returning cached user");
    return cachedUser!.user;
  }

  // 3️⃣ Check for mock test user
  if (authToken.startsWith("mock_test_token_") || authToken.startsWith("demo_seed_token_")) {
    const mockUser = localStorage.getItem("auth_user");
    if (mockUser) {
      cachedUser = {
        user: JSON.parse(mockUser),
        timestamp: Date.now(),
        tokenHash: getTokenHash(authToken),
      };
      return cachedUser.user;
    }
  }

  try {
    console.log("[Auth] Fetching user from API with token:", authToken.substring(0, 10) + "...");
    
    const response = await fetch(`${apiEndpointBaseURL}/dashboard/user`, {
      headers: {
        authorization: `Bearer ${authToken}`,
        "Content-Type": "application/json",
        // Add cache-busting headers
        "Cache-Control": "no-cache",
        "Pragma": "no-cache",
      },
    });

    console.log("[Auth] API Response status:", response.status);

    // 4️⃣ Token expired or invalid → clear everything
    if (response.status === 401) {
      console.log("[Auth] Token expired/invalid, clearing...");
      localStorage.removeItem("auth_token");
      cachedUser = null;
      return null;
    }

    // 5️⃣ Network or server errors → try to return cached data if available
    if (!response.ok) {
      console.error("[Auth] Error fetching user:", await response.clone().json().catch(() => ({ message: "Unknown error" })));
      
      // Return stale cache if available (better than nothing)
      if (cachedUser) {
        console.log("[Auth] Returning stale cache due to error");
        return cachedUser.user;
      }
      return null;
    }

    // 6️⃣ Success — user returned
    const user = await response.json();
    
    // Update cache
    cachedUser = {
      user,
      timestamp: Date.now(),
      tokenHash: getTokenHash(authToken),
    };
    
    console.log("[Auth] User fetched successfully:", user?.email);
    return user;
  } catch (error) {
    console.error("[Auth] Network error:", error);
    
    // Return stale cache if available during network errors
    if (cachedUser) {
      console.log("[Auth] Returning stale cache due to network error");
      return cachedUser.user;
    }
    
    return null;
  }
}

// Export function to clear auth cache manually (useful for logout)
export function clearAuthCache() {
  cachedUser = null;
  console.log("[Auth] Cache cleared");
}
