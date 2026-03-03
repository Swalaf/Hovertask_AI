import EarnByHelpingSection from "./components/EarnByHelpingSection";
import Hero from "./components/Hero";
import HowToUseSection from "./components/HowToUse";
import JoinUsSection from "./components/JoinUsSection";
import Newsletter from "./components/NewsLetter";
import SocialMediaAdvertSection from "./components/SocialMediaAdvertSection";
import ReferAndEarn from "./components/ReferAndEarn";

const LandingPage = () => {
    return (
        <>
            <Hero />
            <SocialMediaAdvertSection />
            <HowToUseSection />
            <EarnByHelpingSection />
            <ReferAndEarn />
            <JoinUsSection />
            <Newsletter />
        </>
    );
};

export default LandingPage;
