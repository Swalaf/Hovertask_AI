import type { FieldValues } from "react-hook-form";
import { toast } from "sonner";

const signin = async (form: FieldValues) => {
	const API_BASE_URL = import.meta.env.VITE_API_URL || "https://backend.hovertask.com";
	const API_ENDPOINT = `${API_BASE_URL}/api/login`;

	try {
		const response = await fetch(API_ENDPOINT, {
			method: "POST",
			body: JSON.stringify(form),
			headers: { "Content-Type": "application/json" },
		});

		const data = await response.json();

		if (response.ok && data.status) {
			// ✅ Save token in localStorage
			localStorage.setItem("auth_token", data.token);

			// ✅ Redirect user to dashboard
			window.location.assign(`${import.meta.env.VITE_DASHBOARD_URL || "https://app.hovertask.com"}/?token=${data.token}`);
		} else {
			// Invalid login
			toast.error(data.message || "Invalid credentials, please try again.");
		}
	} catch (error: unknown) {
		if (error instanceof Error) toast.error(error.message);
		else toast.error("An unknown error occurred");
	}
};

export default signin;
