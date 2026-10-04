
<div
    id="cookie-consent-overlay"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/70 p-4 backdrop-blur-sm"
>
    <div class="w-full max-w-lg rounded-2xl border border-slate-200 bg-white p-8 shadow-2xl">
        <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-lg bg-red-50 text-[#e21838]">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.75"
            >
                <circle cx="12" cy="12" r="9" />
                <circle cx="9" cy="10" r="1" fill="currentColor" stroke="none" />
                <circle cx="14" cy="8.5" r="1" fill="currentColor" stroke="none" />
                <circle cx="15" cy="14" r="1" fill="currentColor" stroke="none" />
                <circle cx="10" cy="15" r="1" fill="currentColor" stroke="none" />
            </svg>
        </div>

        <h2 class="text-xl font-black tracking-tight text-slate-900">Σεβόμαστε το απόρρητό σας</h2>
        <p class="mt-3 text-sm leading-relaxed text-slate-500">
            Χρησιμοποιούμε cookies για τη σωστή λειτουργία του site, καθώς και — μόνο με τη συγκατάθεσή σας — για
            στατιστικά επισκεψιμότητας και προσαρμοσμένο περιεχόμενο. Διαβάστε την
            <a href="/privacy" class="font-semibold text-[#e21838] hover:underline">Πολιτική Απορρήτου</a>
            και τους
            <a href="/terms" class="font-semibold text-[#e21838] hover:underline">Όρους Χρήσης</a>
            .
        </p>

        <details class="group mt-5 rounded-xl border border-slate-200">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-3 text-sm font-bold text-slate-700"
            >
                Διαχείριση προτιμήσεων
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 text-slate-400 transition-transform group-open:rotate-180"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>

            <div class="space-y-4 border-t border-slate-100 px-4 py-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm font-bold text-slate-800">Απαραίτητα</div>
                        <p class="mt-0.5 text-xs text-slate-500">
                            Απαιτούνται για τη βασική λειτουργία του site (π.χ. φόρμες παραγγελίας). Δεν
                            απενεργοποιούνται.
                        </p>
                    </div>
                    <span class="mt-1 inline-flex h-6 w-11 shrink-0 items-center rounded-full bg-slate-300 px-0.5">
                        <span class="h-5 w-5 translate-x-5 rounded-full bg-white shadow"></span>
                    </span>
                </div>

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <label for="consent-analytics" class="text-sm font-bold text-slate-800">Στατιστικά</label>
                        <p class="mt-0.5 text-xs text-slate-500">
                            Μας βοηθούν να καταλάβουμε πώς χρησιμοποιείται το site, ανώνυμα.
                        </p>
                    </div>
                    <input
                        type="checkbox"
                        id="consent-analytics"
                        class="consent-toggle mt-1 h-5 w-5 shrink-0 rounded border-slate-300 text-[#e21838] focus:ring-[#e21838]"
                    />
                </div>

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <label for="consent-marketing" class="text-sm font-bold text-slate-800">Μάρκετινγκ</label>
                        <p class="mt-0.5 text-xs text-slate-500">
                            Χρησιμοποιούνται για προσαρμοσμένες προσφορές και διαφημίσεις.
                        </p>
                    </div>
                    <input
                        type="checkbox"
                        id="consent-marketing"
                        class="consent-toggle mt-1 h-5 w-5 shrink-0 rounded border-slate-300 text-[#e21838] focus:ring-[#e21838]"
                    />
                </div>

                <button
                    type="button"
                    id="cookie-consent-save"
                    class="mt-2 w-full rounded-lg border border-slate-300 py-2.5 text-sm font-bold text-slate-700 transition-colors hover:bg-slate-50"
                >
                    Αποθήκευση επιλογών
                </button>
            </div>
        </details>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
            <button
                type="button"
                id="cookie-consent-reject"
                class="flex-1 rounded-lg border border-slate-300 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-slate-50"
            >
                Απόρριψη μη απαραίτητων
            </button>
            <button
                type="button"
                id="cookie-consent-accept"
                class="flex-1 rounded-lg bg-[#e21838] py-3 text-sm font-bold text-white transition-colors hover:bg-red-700"
            >
                Αποδοχή όλων
            </button>
        </div>
    </div>
</div>

<button
    type="button"
    id="cookie-settings-reopen"
    class="fixed bottom-5 left-5 z-40 hidden h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-lg transition-colors hover:text-[#e21838]"
    aria-label="Ρυθμίσεις cookies"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="1.75"
    >
        <circle cx="12" cy="12" r="9" />
        <circle cx="9" cy="10" r="1" fill="currentColor" stroke="none" />
        <circle cx="14" cy="8.5" r="1" fill="currentColor" stroke="none" />
        <circle cx="15" cy="14" r="1" fill="currentColor" stroke="none" />
        <circle cx="10" cy="15" r="1" fill="currentColor" stroke="none" />
    </svg>
</button>

<script>
    ;(function () {
        const STORAGE_KEY = 'eko_cookie_consent'
        const CONSENT_LIFETIME_DAYS = 180

        const overlay = document.getElementById('cookie-consent-overlay')
        const reopenBtn = document.getElementById('cookie-settings-reopen')
        const analyticsToggle = document.getElementById('consent-analytics')
        const marketingToggle = document.getElementById('consent-marketing')

        function readConsent() {
            try {
                const raw = localStorage.getItem(STORAGE_KEY)
                if (!raw) return null
                const data = JSON.parse(raw)
                const ageDays = (Date.now() - data.timestamp) / (1000 * 60 * 60 * 24)
                if (ageDays > CONSENT_LIFETIME_DAYS) return null
                return data
            } catch (e) {
                return null
            }
        }

        function saveConsent(analytics, marketing) {
            const data = {
                necessary: true,
                analytics: analytics,
                marketing: marketing,
                timestamp: Date.now(),
            }
            localStorage.setItem(STORAGE_KEY, JSON.stringify(data))
            applyConsent(data)
            hideModal()
        }

        const GTM_ID = 'GTM-W4HRVVHS'
        let gtmLoaded = false

        function loadGTM() {
            if (gtmLoaded) return
            gtmLoaded = true

            window.dataLayer = window.dataLayer || []
            window.dataLayer.push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' })

            const script = document.createElement('script')
            script.async = true
            script.src = 'https://www.googletagmanager.com/gtm.js?id=' + GTM_ID
            document.head.appendChild(script)

            const noscript = document.createElement('noscript')
            const iframe = document.createElement('iframe')
            iframe.src = 'https://www.googletagmanager.com/ns.html?id=' + GTM_ID
            iframe.height = '0'
            iframe.width = '0'
            iframe.style.display = 'none'
            iframe.style.visibility = 'hidden'
            noscript.appendChild(iframe)
            document.body.insertBefore(noscript, document.body.firstChild)
        }

        function applyConsent(data) {
            if (data.analytics) {
                loadGTM()
            }
            document.dispatchEvent(new CustomEvent('cookieConsentUpdated', { detail: data }))
        }

        function showModal() {
            overlay.classList.remove('hidden')
            overlay.classList.add('flex')
        }

        function hideModal() {
            overlay.classList.add('hidden')
            overlay.classList.remove('flex')
            reopenBtn.classList.remove('hidden')
            reopenBtn.classList.add('flex')
        }

        document.getElementById('cookie-consent-accept').addEventListener('click', () => saveConsent(true, true))
        document.getElementById('cookie-consent-reject').addEventListener('click', () => saveConsent(false, false))
        document
            .getElementById('cookie-consent-save')
            .addEventListener('click', () => saveConsent(analyticsToggle.checked, marketingToggle.checked))

        reopenBtn.addEventListener('click', () => {
            const existing = readConsent()
            if (existing) {
                analyticsToggle.checked = existing.analytics
                marketingToggle.checked = existing.marketing
            }
            showModal()
        })

        const existing = readConsent()
        if (existing) {
            applyConsent(existing)
            reopenBtn.classList.remove('hidden')
            reopenBtn.classList.add('flex')
        } else {
            showModal()
        }
    })()
</script>
