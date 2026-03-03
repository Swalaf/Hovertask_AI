import React, { useState } from "react";

interface ResetPasswordModalProps {
  isOpen: boolean;
  onClose: () => void;
  maskedEmail: string;
  email: string;
}

const ResetPasswordModal: React.FC<ResetPasswordModalProps> = ({ isOpen, onClose, maskedEmail, email }) => {
  const [code, setCode] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState(""); // NEW STATE
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState("");

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setMessage("");

    if (password !== confirmPassword) {
      setMessage("Passwords do not match.");
      setLoading(false);
      return;
    }

    try {
      const res = await fetch("https://backend.hovertask.com/api/password/reset", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ 
          email, 
          code, 
          password, 
          password_confirmation: confirmPassword // SEND CONFIRMATION
        }),
      });

      const data = await res.json();
      if (res.ok) {
        setMessage(data.message || "Password reset successful!");
      } else {
        setMessage(data.message || "Failed to reset password.");
      }
    } catch {
      setMessage("An error occurred. Please try again.");
    }

    setLoading(false);
  };

  if (!isOpen) return null;

  return (
    <div style={{
      position: "fixed", top: 0, left: 0, width: "100vw", height: "100vh",
      background: "rgba(0,0,0,0.3)", display: "flex", alignItems: "center", justifyContent: "center", zIndex: 1000
    }}>
      <div style={{
        background: "#fff",
        borderRadius: "32px",
        padding: "2.5rem 2rem 2rem 2rem",
        minWidth: 380,
        maxWidth: 420,
        width: "90vw",
        boxShadow: "0 2px 24px rgba(0,0,0,0.10)",
        position: "relative",
        textAlign: "center"
      }}>
        {/* Close Button */}
        <button
          onClick={onClose}
          aria-label="Close"
          style={{
            position: "absolute",
            top: 24,
            right: 24,
            background: "none",
            border: "none",
            fontSize: 32,
            color: "#222",
            cursor: "pointer",
            lineHeight: 1,
          }}
        >
          &times;
        </button>

        <h2 style={{
          fontWeight: 700,
          fontSize: "1.6rem",
          margin: "0 0 0.5rem 0"
        }}>
          Reset Password
        </h2>

        <div style={{
          color: "#555",
          fontSize: "1rem",
          marginBottom: "1.5rem"
        }}>
          Enter the reset code sent to your registered email<br />
          <span style={{ color: "#222", fontWeight: 500 }}>{maskedEmail}</span><br />
          and create a new password to secure your account.
        </div>

        <form onSubmit={handleSubmit}>
          <input
            type="text"
            placeholder="Enter the code here"
            required
            value={code}
            onChange={e => setCode(e.target.value)}
            style={{
              width: "100%",
              padding: "0.9rem 1rem",
              borderRadius: "16px",
              border: "1px solid #E0E0E0",
              background: "#F8F8F8",
              fontSize: "1rem",
              marginBottom: "0.5rem",
              outline: "none",
              textAlign: "center"
            }}
          />

          <input
            type="password"
            placeholder="Enter new password"
            required
            minLength={6}
            value={password}
            onChange={e => setPassword(e.target.value)}
            style={{
              width: "100%",
              padding: "0.9rem 1rem",
              borderRadius: "16px",
              border: "1px solid #E0E0E0",
              background: "#F8F8F8",
              fontSize: "1rem",
              marginBottom: "0.5rem",
              outline: "none",
              textAlign: "center"
            }}
          />

          {/* NEW FIELD FOR CONFIRMATION */}
          <input
            type="password"
            placeholder="Confirm new password"
            required
            minLength={6}
            value={confirmPassword}
            onChange={e => setConfirmPassword(e.target.value)}
            style={{
              width: "100%",
              padding: "0.9rem 1rem",
              borderRadius: "16px",
              border: "1px solid #E0E0E0",
              background: "#F8F8F8",
              fontSize: "1rem",
              marginBottom: "0.5rem",
              outline: "none",
              textAlign: "center"
            }}
          />

          <div style={{ color: "#888", fontSize: "0.95rem", marginBottom: "1.2rem" }}>
            Password must be at least 6 characters long and match confirmation.
          </div>

          <button
            type="submit"
            disabled={loading}
            style={{
              width: "70%",
              padding: "0.85rem 0",
              borderRadius: "26px",
              background: "#316FEA",
              color: "#fff",
              border: "none",
              fontWeight: 600,
              fontSize: "1.1rem",
              cursor: "pointer",
              margin: "0 auto",
              display: "block",
              boxShadow: "0 2px 8px rgba(49,111,234,0.10)"
            }}
          >
            {loading ? "Processing..." : "Reset Password"}
          </button>
        </form>

        {message && <div style={{ marginTop: 12, color: "#1976d2" }}>{message}</div>}
      </div>
    </div>
  );
};

export default ResetPasswordModal;
