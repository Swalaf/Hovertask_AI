import type { FieldValues } from "react-hook-form";
import { toast } from "sonner";

const signup = async (form: FieldValues, callback: () => unknown) => {
    const API_ENDPOINT = "https://backend.hovertask.com/api/register";

    try {
        const response = await fetch(API_ENDPOINT, {
            method: "POST",
            body: JSON.stringify(form),
            headers: { "Content-Type": "application/json" }
        });

        if (response.ok) callback();
        else {
            const data = await response.json();
            toast.error(data.message || "An error occurred. Please try again");
        }
    } catch (error: unknown) {
        if (error instanceof Error)
            toast.error(error.message);
        else toast.error("An unknown error ocurred")
    }
};

export default signup;
