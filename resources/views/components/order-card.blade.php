@props(['heading', 'intro', 'fields' => []])

<section class="bg-slate-50 py-8 sm:py-12">
    <div class="mx-auto grid max-w-5xl grid-cols-1 gap-6 px-4 lg:grid-cols-[minmax(0,1fr)_320px]">
        <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6">
            <h1 class="text-xl font-bold text-slate-900">{{ $heading }}</h1>
            <p class="mt-0.5 mb-5 text-sm text-slate-500">{{ $intro }}</p>

            @if (session('success'))
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-[13px] text-emerald-800" role="status">
                    <p class="font-semibold">{{ session('success') }}</p>
                    <p>Θα επικοινωνήσουμε μαζί σας τηλεφωνικά για την προσφορά.</p>
                </div>
            @endif

            @if ($errors->any() && ! $errors->hasAny($fields))
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[13px] text-red-700" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{ $slot }}
        </div>

        <aside class="space-y-4 text-sm">
            {{ $aside ?? '' }}
            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <h2 class="text-sm font-bold text-slate-900">Επικοινωνία</h2>
                <p class="mt-1 text-slate-600">Για οποιαδήποτε απορία καλέστε μας.</p>
                <a href="tel:2410283954" class="mt-2 inline-block font-semibold text-[#e21838] hover:underline">2410 283954</a>
            </div>
        </aside>
    </div>
</section>

<script>
    document.querySelectorAll('form[data-order-form]').forEach(form => {
        form.addEventListener('submit', () => {
            const button = form.querySelector('button[type="submit"]')
            setTimeout(() => {
                button.disabled = true
                button.textContent = 'Αποστολή...'
            }, 0)
        })
        form.querySelectorAll('input[inputmode="numeric"]').forEach(input => {
            input.addEventListener('input', () => (input.value = input.value.replace(/\D/g, '').slice(0, input.maxLength > 0 ? input.maxLength : undefined)))
        })
    })
</script>
