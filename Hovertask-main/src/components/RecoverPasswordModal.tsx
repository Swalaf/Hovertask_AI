import React, { useState } from "react";
import ResetPasswordModal from "./ResetPasswordModal";

interface RecoverPasswordModalProps {
  isOpen: boolean;
  onClose: () => void;
}

const RecoverPasswordModal: React.FC<RecoverPasswordModalProps> = ({ isOpen, onClose }) => {
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState("");
  const [showResetModal, setShowResetModal] = useState(false);
  const [maskedEmail, setMaskedEmail] = useState("");
  const [userEmail, setUserEmail] = useState("");

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setMessage("");
    try {
      const res = await fetch("https://backend.hovertask.com/api/reset-password", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email: input }),
      });
      const data = await res.json();
      if (res.ok) {
        setMessage(data.message || "Password reset link sent! Check your email or phone.");
        setMaskedEmail(data.maskedEmail || input);
        setUserEmail(input); // Save the email/username/phone used
        setTimeout(() => {
          setShowResetModal(true);
        }, 1000); // Show after a short delay
      } else {
        setMessage(data.message || "Failed to send reset link. Try again.");
      }
    } catch {
      setMessage("An error occurred. Please try again.");
    }
    setLoading(false);
  };

  if (!isOpen) return null;

  return (
    <>
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
            Forgot Password?
          </h2>
          <div style={{
            color: "#555",
            fontSize: "1rem",
            marginBottom: "1.5rem"
          }}>
            Enter your Username or Email or Phone Number to reset your password
          </div>
          <form onSubmit={handleSubmit}>
            <input
              type="text"
              placeholder="Email address"
              required
              value={input}
              onChange={e => setInput(e.target.value)}
              style={{
                width: "100%",
                padding: "0.9rem 1rem",
                borderRadius: "16px",
                border: "1px solid #E0E0E0",
                background: "#F8F8F8",
                fontSize: "1rem",
                marginBottom: "1.5rem",
                outline: "none",
                textAlign: "center"
              }}
            />
            <button
              type="submit"
              disabled={loading}
              style={{
                width: "60%",
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
              {loading ? "Processing..." : "Proceed"}
            </button>
          </form>
          {message && <div style={{ marginTop: 12, color: "#1976d2" }}>{message}</div>}
        </div>
      </div>
      <ResetPasswordModal
        isOpen={showResetModal}
        onClose={() => {
          setShowResetModal(false);
          onClose();
        }}
        maskedEmail={maskedEmail}
        email={userEmail}
      />
    </>
  );
};

export default RecoverPasswordModal;