export default function AppLogo() {
    return (
        <div className="mb-2 flex max-h-16 w-full items-center justify-center gap-2">
            <img
                src="/atheer-logo-black.svg"
                alt="Al-Ather"
                className="max-h-16 object-cover dark:hidden"
            />
            <img
                src="/atheer-logo-sandbeach.svg"
                alt="Al-Ather"
                className="hidden max-h-16 object-cover dark:block"
            />
        </div>
    );
}
