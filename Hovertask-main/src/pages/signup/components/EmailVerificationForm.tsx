import { useForm } from "react-hook-form";
import { useState } from "react";
import Input from "../../../components/Input";


interface VerificationFormData {
  code: string;
}

interface EmailVerificationFormProps {
  onSubmit: (code: string) => void;
  email?: string;
}

const EmailVerificationForm = ({ onSubmit, email }: EmailVerificationFormProps) => {
  const { register, handleSubmit, formState: { errors } } = useForm<VerificationFormData>();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const handleVerify: (data: VerificationFormData) => Promise<void> = async (data) => {
    setLoading(true);
    setError(null);
    try {
      const response = await fetch("https://backend.hovertask.com/api/verify-email-code", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ code: data.code, email }),
      });
      if (response.ok) {
        onSubmit(data.code);
      } else {
        const res = await response.json();
        setError(res.message || "Verification failed. Try again.");
      }
    } catch (e) {
      setError("Network error. Try again.");
    }
    setLoading(false);
  };

  const [resendLoading, setResendLoading] = useState(false);
  const [resendMessage, setResendMessage] = useState<string | null>(null);

  const handleResend = async () => {
    setResendLoading(true);
    setResendMessage(null);
    try {
      const response = await fetch("https://backend.hovertask.com/api/resend-email-code", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email }),
      });
      if (response.ok) {
        setResendMessage("A new code has been sent to your email.");
      } else {
        const res = await response.json();
        setResendMessage(res.message || "Failed to resend code. Try again.");
      }
    } catch (e) {
      setResendMessage("Network error. Try again.");
    }
    setResendLoading(false);
  };

  return (
    <div className="w-full min-w-full max-w-full">
      <div className="mb-8">
        <h2 className="text-2xl font-bold text-gray-800">Verify Your Email</h2>
        <p className="text-gray-600 mt-2">Enter the code sent to your email to complete registration</p>
      </div>
      <form onSubmit={handleSubmit(handleVerify)} className="space-y-6">
        <Input
          label="Verification Code"
          id="code"
          type="text"
          {...register("code", { required: "Please enter the code" })}
        />
        <small className="text-red-500">{errors.code?.message && String(errors.code.message)}</small>
        {error && <div className="text-red-500 text-sm">{error}</div>}
        <button
          type="submit"
          className="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg font-medium transition-colors duration-200 shadow-lg shadow-blue-600/20 mt-6"
          disabled={loading}
        >
          {loading ? "Verifying..." : "Verify Email"}
        </button>
      </form>
      <div className="mt-4 text-center">
        <button
          type="button"
          className="text-blue-600 hover:text-blue-700 font-medium underline"
          onClick={handleResend}
          disabled={resendLoading}
        >
          {resendLoading ? "Resending..." : "Resend Code"}
        </button>
        {resendMessage && <div className="text-green-600 text-sm mt-2">{resendMessage}</div>}
      </div>
    </div>
  );
};

export default EmailVerificationForm;
