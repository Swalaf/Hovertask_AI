import { useState } from "react";
import { Link } from "react-router-dom";

const Newsletter = () => {
    const [email, setEmail] = useState("");
    const [submitted, setSubmitted] = useState(false);

    const handleSubmit = (event: React.FormEvent) => {
        event.preventDefault();
        // Simulate submission
        setSubmitted(true);
        setEmail("");
        setTimeout(() => setSubmitted(false), 3000);
    };

    return (
        <section className="bg-gradient-to-br from-gray-50 to-white dark:from-slate-800 dark:to-slate-900 rounded-2xl p-8 md:p-12 space-y-6 max-w-3xl mx-auto mb-16">
            <div className="text-center space-y-3">
                <h2 className="text-2xl md:text-3xl font-bold bg-gradient-to-r from-[#2C418F] to-blue-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 text-transparent bg-clip-text">
                    Stay Updated with HoverTask
                </h2>
                <p className="text-gray-600 dark:text-slate-300 max-w-md mx-auto">
                    Sign up for the latest tasks, offers, and platform updates delivered to your inbox.
                </p>
            </div>

            {submitted ? (
                <div className="text-center py-4">
                    <div className="inline-flex items-center gap-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-6 py-3 rounded-xl">
                        <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                        </svg>
                        Thanks for subscribing!
                    </div>
                </div>
            ) : (
                <form
                    onSubmit={handleSubmit}
                    className="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto"
                >
                    <input
                        type="email"
                        required
                        placeholder="Enter your email address"
                        className="flex-1 min-w-0 px-5 py-3 rounded-xl border border-gray-200 dark:border-slate-600 dark:bg-slate-800 dark:text-white focus:border-[#2C418F] dark:focus:border-indigo-400 focus:ring-2 focus:ring-[#2C418F]/20 dark:focus:ring-indigo-500/20 outline-none transition-all"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />

                    <button
                        type="submit"
                        className="bg-gradient-to-r from-[#2C418F] to-blue-600 hover:from-blue-600 hover:to-blue-700 dark:from-indigo-600 dark:to-purple-600 dark:hover:from-indigo-500 dark:hover:to-purple-500 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 whitespace-nowrap"
                    >
                        Subscribe
                    </button>
                </form>
            )}
            
            <p className="text-center text-sm text-gray-500 dark:text-slate-400">
                Already have an account?{" "}
                <Link to="/signin" className="text-[#2C418F] dark:text-indigo-400 hover:text-blue-700 dark:hover:text-indigo-300 font-semibold">
                    Sign in here
                </Link>
            </p>
        </section>
    );
};

export default Newsletter;
