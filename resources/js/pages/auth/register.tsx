export default function Register() {
    return (
        <div className="flex min-h-screen items-center justify-center bg-gray-100">
            <div className="w-full max-w-md rounded-2xl bg-white p-8 shadow-md">
                <h2 className="mb-2 text-center text-2xl font-semibold text-black">
                    Selamat Datang
                </h2>
                <p className="mb-6 text-center text-gray-500">
                    Silahkan daftarkan akun SIP-KIB anda!
                </p>

                <form>
                    <div className="mb-4">
                        <label className="mb-1 block text-sm font-medium text-gray-700">
                            Nama
                        </label>
                        <input
                            type="text"
                            placeholder="Masukkan nama anda"
                            className="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-500 focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />
                    </div>

                    <div className="mb-4">
                        <label className="mb-1 block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input
                            type="email"
                            placeholder="Masukkan email anda"
                            className="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-500 focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />
                    </div>

                    <div className="mb-4">
                        <label className="mb-1 block text-sm font-medium text-gray-700">
                            Username
                        </label>
                        <input
                            type="text"
                            placeholder="Masukkan username anda"
                            className="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-500 focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />
                    </div>

                    <div className="mb-6">
                        <label className="mb-1 block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input
                            type="password"
                            placeholder="Masukkan setidaknya 8 karakter"
                            className="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 placeholder-gray-500 focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />
                    </div>

                    <button
                        type="submit"
                        className="w-full rounded-lg bg-green-500 py-2 text-white transition hover:bg-green-600"
                    >
                        Buat Akun
                    </button>
                </form>

                <p className="mt-4 text-center text-sm text-gray-600">
                    Sudah punya akun?{' '}
                    <a
                        href="/login"
                        className="font-medium text-blue-600 hover:underline"
                    >
                        Masuk disini
                    </a>
                </p>
            </div>
        </div>
    );
}
