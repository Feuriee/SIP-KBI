export default function Login() {
    return (
        <div className="flex min-h-screen items-center justify-center bg-gray-100">
            <div className="w-full max-w-md rounded-2xl bg-white p-8 shadow-md">
                <h2 className="mb-2 text-center text-2xl font-semibold text-black">
                    Selamat Datang
                </h2>
                <p className="mb-6 text-center text-gray-500">
                    Silahkan login dengan akun SIP-KIB
                </p>

                <form>
                    <div className="mb-4">
                        <label className="mb-1 block text-sm font-medium text-gray-700">
                            Username
                        </label>
                        <input
                            type="text"
                            placeholder="Masukkan Username anda"
                            className="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-500 focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />
                    </div>

                    <div className="mb-6">
                        <label className="mb-1 block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input
                            type="password"
                            placeholder="Masukkan password anda"
                            className="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-500 focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />
                    </div>

                    <button
                        type="submit"
                        className="w-full rounded-lg bg-blue-600 py-2 text-white transition hover:bg-blue-700"
                    >
                        Masuk
                    </button>

                    <p className="mt-2 text-center text-gray-500">
                        atau login menggunakan
                    </p>

                    <div className="mt-4">
                        <a
                            href="/auth/google/redirect"
                            className="flex w-full items-center justify-center gap-2 rounded bg-gray-300 py-2 text-white hover:bg-gray-400"
                        >
                            <img
                                src="img/google-icon.png"
                                alt="Google"
                                className="h-5 w-5"
                            />
                            Google
                        </a>
                    </div>
                </form>

                <p className="mt-4 text-center text-sm text-gray-600">
                    Belum punya akun?{' '}
                    <a
                        href="/register"
                        className="font-medium text-blue-600 hover:underline"
                    >
                        Daftar disini
                    </a>
                </p>
            </div>
        </div>
    );
}
