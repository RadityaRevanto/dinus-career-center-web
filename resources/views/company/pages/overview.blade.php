@extends('company.layouts.app')
@section('content')
    <div class="grid grid-cols-12 gap-6">

            <!-- BAGIAN KIRI -->
            <div class="col-span-12 xl:col-span-8 flex flex-col gap-6">
                
                <!-- KIRI ATAS: Stats -->
                <div class="flex flex-col gap-6 w-full">
                    <div class="rounded-xl p-4 border border-solid border-gray-200 grid grid-cols-12">
                        <div class="col-span-12 lg:col-span-5">
                            <div class="grid grid-cols-2">
                                <div class="border-r border-b border-gray-200 pt-2 pr-4 pb-4 pl-2">
                                    <div class="rounded-lg p-2.5 bg-amber-50 w-max mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M13.3332 5.83333C13.3332 7.67428 11.8408 9.16667 9.99985 9.16667C8.1589 9.16667 6.66652 7.67428 6.66652 5.83333C6.66652 3.99238 8.1589 2.5 9.99985 2.5C11.8408 2.5 13.3332 3.99238 13.3332 5.83333Z"
                                                stroke="#F59E0B" stroke-width="1.6"></path>
                                            <path
                                                d="M9.99985 11.6667C7.62629 11.6667 5.54244 12.752 4.36118 14.3865C3.73618 15.2513 3.42368 15.6837 3.88785 16.5918C4.35201 17.5 5.12351 17.5 6.66652 17.5H13.3332C14.8762 17.5 15.6477 17.5 16.1119 16.5918C16.576 15.6837 16.2635 15.2513 15.6385 14.3865C14.4573 12.752 12.3734 11.6667 9.99985 11.6667Z"
                                                stroke="#F59E0B" stroke-width="1.6"></path>
                                        </svg>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <h5 class="text-xl font-semibold text-gray-900 leading-8">1012</h5>
                                        <span
                                            class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-1">
                                            <span class="flex mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                    viewBox="0 0 10 10" fill="none">
                                                    <path
                                                        d="M1.25 6.9334L3.71422 4.46944L5.53072 6.28593L8.75 3.06665M8.75 3.06665H6.04626M8.75 3.06665V5.80634"
                                                        stroke="#059669" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                            </span>30%</span>
                                    </div>
                                    <h6 class="text-xs font-normal text-gray-500">New Employee</h6>
                                </div>
                                <div class="border-b border-gray-200 pt-2 pb-4 pl-6">
                                    <div class="rounded-lg p-2.5 bg-sky-50 w-max mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16"
                                            viewBox="0 0 20 16" fill="none">
                                            <path
                                                d="M19.1659 15.1505C19.1659 11.5054 16.7035 8.55042 13.6658 8.55042M13.6658 8.55042C10.6282 8.55042 8.16574 11.5054 8.16574 15.1505M13.6658 8.55042C11.8939 8.55042 10.4575 6.82614 10.4575 4.69981C10.4575 2.57347 11.8939 0.849731 13.6659 0.849731C15.4378 0.849731 16.8743 2.57347 16.8743 4.69981C16.8743 6.82614 15.4378 8.55042 13.6658 8.55042ZM0.834045 14.0505C0.834045 11.0129 2.88611 8.55042 5.41747 8.55042C6.69963 8.55042 7.85883 9.18218 8.69069 10.2004M3.12419 5.72234C3.12419 7.24116 4.15023 8.4724 5.4159 8.4724C6.68158 8.4724 7.70761 7.24116 7.70761 5.72234C7.70761 4.20353 6.68158 2.97229 5.4159 2.97229C4.15023 2.97229 3.12419 4.20353 3.12419 5.72234Z"
                                                stroke="#0284C7" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <h5 class="text-xl font-semibold text-gray-900 leading-8">102</h5>
                                        <span
                                            class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-1">
                                            <span class="flex mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                    viewBox="0 0 10 10" fill="none">
                                                    <path
                                                        d="M1.25 6.9334L3.71422 4.46944L5.53072 6.28593L8.75 3.06665M8.75 3.06665H6.04626M8.75 3.06665V5.80634"
                                                        stroke="#059669" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                            </span>22%</span>
                                    </div>
                                    <h6 class="text-xs font-normal text-gray-500">Resign Employee</h6>
                                </div>
                                <div class="border-r border-gray-200 pt-4 pr-4 pb-2 pl-2">
                                    <div class="rounded-lg p-2.5 bg-blue-50 w-max mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M14.1667 3.75001L14.1667 4.55001L14.1667 3.75001ZM5.83333 3.75002L5.83333 2.95002L5.83333 3.75002ZM6.70898 12.4667C7.15081 12.4667 7.50898 12.1085 7.50898 11.6667C7.50898 11.2248 7.15081 10.8667 6.70898 10.8667V12.4667ZM6.66732 10.8667C6.22549 10.8667 5.86732 11.2248 5.86732 11.6667C5.86732 12.1085 6.22549 12.4667 6.66732 12.4667V10.8667ZM6.70898 14.9667C7.15081 14.9667 7.50898 14.6085 7.50898 14.1667C7.50898 13.7248 7.15081 13.3667 6.70898 13.3667V14.9667ZM6.66732 13.3667C6.22549 13.3667 5.86732 13.7248 5.86732 14.1667C5.86732 14.6085 6.22549 14.9667 6.66732 14.9667V13.3667ZM10.0423 12.4667C10.4841 12.4667 10.8423 12.1085 10.8423 11.6667C10.8423 11.2248 10.4841 10.8667 10.0423 10.8667V12.4667ZM10.0007 10.8667C9.55882 10.8667 9.20065 11.2248 9.20065 11.6667C9.20065 12.1085 9.55882 12.4667 10.0007 12.4667V10.8667ZM10.0423 14.9667C10.4841 14.9667 10.8423 14.6085 10.8423 14.1667C10.8423 13.7248 10.4841 13.3667 10.0423 13.3667V14.9667ZM10.0007 13.3667C9.55882 13.3667 9.20065 13.7248 9.20065 14.1667C9.20065 14.6085 9.55882 14.9667 10.0007 14.9667V13.3667ZM13.3757 12.4667C13.8175 12.4667 14.1757 12.1085 14.1757 11.6667C14.1757 11.2248 13.8175 10.8667 13.3757 10.8667V12.4667ZM13.334 10.8667C12.8922 10.8667 12.534 11.2248 12.534 11.6667C12.534 12.1085 12.8922 12.4667 13.334 12.4667V10.8667ZM13.3757 14.9667C13.8175 14.9667 14.1757 14.6085 14.1757 14.1667C14.1757 13.7248 13.8175 13.3667 13.3757 13.3667V14.9667ZM13.334 13.3667C12.8922 13.3667 12.534 13.7248 12.534 14.1667C12.534 14.6085 12.8922 14.9667 13.334 14.9667V13.3667ZM7.46667 2.5C7.46667 2.05817 7.10849 1.7 6.66667 1.7C6.22484 1.7 5.86667 2.05817 5.86667 2.5H7.46667ZM5.86667 5C5.86667 5.44183 6.22484 5.8 6.66667 5.8C7.10849 5.8 7.46667 5.44183 7.46667 5H5.86667ZM14.1333 2.5C14.1333 2.05817 13.7752 1.7 13.3333 1.7C12.8915 1.7 12.5333 2.05817 12.5333 2.5H14.1333ZM12.5333 5C12.5333 5.44183 12.8915 5.8 13.3333 5.8C13.7752 5.8 14.1333 5.44183 14.1333 5H12.5333ZM5.83333 4.55002L14.1667 4.55001L14.1667 2.95001L5.83333 2.95002L5.83333 4.55002ZM16.7 7.08334V14.1667H18.3V7.08334H16.7ZM14.1667 16.7H5.83333V18.3H14.1667V16.7ZM3.3 14.1667V7.08335H1.7V14.1667H3.3ZM5.83333 16.7C5.02504 16.7 4.4993 16.6983 4.11115 16.6461C3.746 16.597 3.6245 16.5168 3.55384 16.4462L2.42247 17.5776C2.83996 17.995 3.35538 18.1589 3.89795 18.2319C4.4175 18.3017 5.07027 18.3 5.83333 18.3V16.7ZM1.7 14.1667C1.7 14.9298 1.6983 15.5825 1.76815 16.1021C1.8411 16.6446 2.00498 17.1601 2.42247 17.5776L3.55384 16.4462C3.48318 16.3755 3.40298 16.254 3.35389 15.8889C3.3017 15.5007 3.3 14.975 3.3 14.1667H1.7ZM16.7 14.1667C16.7 14.975 16.6983 15.5007 16.6461 15.8889C16.597 16.254 16.5168 16.3755 16.4462 16.4462L17.5775 17.5776C17.995 17.1601 18.1589 16.6446 18.2318 16.1021C18.3017 15.5825 18.3 14.9298 18.3 14.1667H16.7ZM14.1667 18.3C14.9297 18.3 15.5825 18.3017 16.1021 18.2319C16.6446 18.1589 17.16 17.995 17.5775 17.5776L16.4462 16.4462C16.3755 16.5168 16.254 16.597 15.8889 16.6461C15.5007 16.6983 14.975 16.7 14.1667 16.7V18.3ZM14.1667 4.55001C14.975 4.55 15.5007 4.5517 15.8889 4.60389C16.254 4.65298 16.3755 4.73318 16.4462 4.80384L17.5775 3.67247C17.16 3.25498 16.6446 3.0911 16.102 3.01816C15.5825 2.9483 14.9297 2.95 14.1667 2.95001L14.1667 4.55001ZM18.3 7.08334C18.3 6.32028 18.3017 5.66751 18.2318 5.14795C18.1589 4.60538 17.995 4.08996 17.5775 3.67247L16.4462 4.80384C16.5168 4.87451 16.597 4.996 16.6461 5.36115C16.6983 5.74931 16.7 6.27505 16.7 7.08334H18.3ZM5.83333 2.95002C5.07027 2.95002 4.4175 2.94832 3.89794 3.01818C3.35538 3.09112 2.83996 3.255 2.42247 3.67249L3.55384 4.80386C3.6245 4.7332 3.746 4.653 4.11114 4.60391C4.4993 4.55172 5.02504 4.55002 5.83333 4.55002L5.83333 2.95002ZM3.3 7.08335C3.3 6.27506 3.3017 5.74933 3.35389 5.36117C3.40298 4.99602 3.48318 4.87453 3.55384 4.80386L2.42247 3.67249C2.00498 4.08999 1.8411 4.6054 1.76815 5.14797C1.6983 5.66752 1.7 6.3203 1.7 7.08335H3.3ZM2.5 9.13333H17.5V7.53333H2.5V9.13333ZM6.70898 10.8667H6.66732V12.4667H6.70898V10.8667ZM6.70898 13.3667H6.66732V14.9667H6.70898V13.3667ZM10.0423 10.8667H10.0007V12.4667H10.0423V10.8667ZM10.0423 13.3667H10.0007V14.9667H10.0423V13.3667ZM13.3757 10.8667H13.334V12.4667H13.3757V10.8667ZM13.3757 13.3667H13.334V14.9667H13.3757V13.3667ZM5.86667 2.5V5H7.46667V2.5H5.86667ZM12.5333 2.5V5H14.1333V2.5H12.5333Z"
                                                fill="#2563EB"></path>
                                        </svg>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <h5 class="text-xl font-semibold text-gray-900 leading-8">23</h5>
                                        <span
                                            class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-1">
                                            <span class="flex mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                    viewBox="0 0 10 10" fill="none">
                                                    <path
                                                        d="M1.25 6.9334L3.71422 4.46944L5.53072 6.28593L8.75 3.06665M8.75 3.06665H6.04626M8.75 3.06665V5.80634"
                                                        stroke="#059669" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                            </span>18%</span>
                                    </div>
                                    <h6 class="text-xs font-normal text-gray-500">Employee on Leave</h6>
                                </div>
                                <div class="pt-4 pb-2 pl-6">
                                    <div class="rounded-lg p-2.5 bg-pink-50 w-max mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M15.8247 5.30278L16.4226 4.77129L16.4226 4.77129L15.8247 5.30278ZM14.3278 3.61879L13.7299 4.15028L13.7299 4.15028L14.3278 3.61879ZM13.2677 2.64627L12.9399 3.37606L12.9399 3.37606L13.2677 2.64627ZM16.5579 6.29136L15.8101 6.57567L15.8101 6.57567L16.5579 6.29136ZM15.9344 16.7678L16.5001 17.3335L16.5001 17.3335L15.9344 16.7678ZM12.1154 5.74182L12.9 5.58574L12.9 5.58574L12.1154 5.74182ZM13.4249 7.05131L13.2688 7.83594L13.2688 7.83594L13.4249 7.05131ZM5.83334 10.0333C5.39152 10.0333 5.03334 10.3915 5.03334 10.8333C5.03334 11.2752 5.39152 11.6333 5.83334 11.6333V10.0333ZM12.5 11.6333C12.9418 11.6333 13.3 11.2752 13.3 10.8333C13.3 10.3915 12.9418 10.0333 12.5 10.0333V11.6333ZM5.83334 12.5333C5.39152 12.5333 5.03334 12.8915 5.03334 13.3333C5.03334 13.7752 5.39152 14.1333 5.83334 14.1333V12.5333ZM10 14.1333C10.4418 14.1333 10.8 13.7752 10.8 13.3333C10.8 12.8915 10.4418 12.5333 10 12.5333V14.1333ZM11.6667 16.7H8.33334V18.3H11.6667V16.7ZM4.13334 12.5V7.5H2.53334V12.5H4.13334ZM15.8667 7.51733V12.5H17.4667V7.51733H15.8667ZM8.33334 3.3H11.8365V1.7H8.33334V3.3ZM11.8365 3.3C12.6448 3.3 12.8071 3.31639 12.9399 3.37606L13.5954 1.91647C13.0768 1.68361 12.5021 1.7 11.8365 1.7V3.3ZM14.9257 3.0873C14.4835 2.58976 14.1139 2.14934 13.5954 1.91647L12.9399 3.37606C13.0728 3.43573 13.1929 3.54614 13.7299 4.15028L14.9257 3.0873ZM17.4667 7.51733C17.4667 6.95027 17.4788 6.46239 17.3057 6.00706L15.8101 6.57567C15.8546 6.69265 15.8667 6.83131 15.8667 7.51733H17.4667ZM15.2268 5.83428C15.6825 6.34701 15.7656 6.45869 15.8101 6.57567L17.3057 6.00706C17.1325 5.55173 16.7994 5.19512 16.4226 4.77129L15.2268 5.83428ZM8.33334 16.7C7.13222 16.7 6.31185 16.6983 5.69676 16.6156C5.10469 16.536 4.82396 16.3948 4.63126 16.2021L3.49989 17.3335C4.03942 17.873 4.71407 18.0979 5.48357 18.2013C6.23005 18.3017 7.17745 18.3 8.33334 18.3V16.7ZM2.53334 12.5C2.53334 13.6559 2.53164 14.6033 2.63201 15.3498C2.73546 16.1193 2.96036 16.7939 3.49989 17.3335L4.63126 16.2021C4.43856 16.0094 4.29734 15.7287 4.21774 15.1366C4.13504 14.5215 4.13334 13.7011 4.13334 12.5H2.53334ZM11.6667 18.3C12.8226 18.3 13.77 18.3017 14.5165 18.2013C15.2859 18.0979 15.9606 17.873 16.5001 17.3335L15.3688 16.2021C15.1761 16.3948 14.8953 16.536 14.3033 16.6156C13.6882 16.6983 12.8678 16.7 11.6667 16.7V18.3ZM15.8667 12.5C15.8667 13.7011 15.865 14.5215 15.7823 15.1366C15.7027 15.7287 15.5615 16.0094 15.3688 16.2021L16.5001 17.3335C17.0397 16.7939 17.2646 16.1193 17.368 15.3498C17.4684 14.6033 17.4667 13.6559 17.4667 12.5H15.8667ZM4.13334 7.5C4.13334 6.29887 4.13504 5.47851 4.21774 4.86342C4.29734 4.27134 4.43856 3.99062 4.63126 3.79792L3.49989 2.66655C2.96036 3.20608 2.73546 3.88073 2.63201 4.65022C2.53164 5.3967 2.53334 6.3441 2.53334 7.5H4.13334ZM8.33334 1.7C7.17745 1.7 6.23005 1.6983 5.48357 1.79866C4.71407 1.90212 4.03942 2.12702 3.49989 2.66655L4.63126 3.79792C4.82396 3.60522 5.10469 3.464 5.69676 3.3844C6.31185 3.3017 7.13222 3.3 8.33334 3.3V1.7ZM11.2833 2.5V5H12.8833V2.5H11.2833ZM14.1667 7.88333H16.6667V6.28333H14.1667V7.88333ZM11.2833 5C11.2833 5.34887 11.2795 5.64013 11.3307 5.89789L12.9 5.58574C12.8872 5.52151 12.8833 5.42556 12.8833 5H11.2833ZM14.1667 6.28333C13.7411 6.28333 13.6452 6.27946 13.5809 6.26668L13.2688 7.83594C13.5265 7.88721 13.8178 7.88333 14.1667 7.88333V6.28333ZM11.3307 5.89789C11.5254 6.87639 12.2903 7.6413 13.2688 7.83594L13.5809 6.26668C13.2371 6.19829 12.9684 5.92954 12.9 5.58574L11.3307 5.89789ZM5.83334 11.6333H12.5V10.0333H5.83334V11.6333ZM5.83334 14.1333H10V12.5333H5.83334V14.1333ZM16.4226 4.77129L14.9257 3.0873L13.7299 4.15028L15.2268 5.83428L16.4226 4.77129Z"
                                                fill="#DB2777"></path>
                                        </svg>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <h5 class="text-xl font-semibold text-gray-900 leading-8">200</h5>
                                        <span
                                            class="inline-flex items-center bg-red-50 text-red-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-1">
                                            <span class="flex mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                    viewBox="0 0 10 10" fill="none">
                                                    <path
                                                        d="M1.25 3.06665L3.71422 5.53061L5.53072 3.71411L8.75 6.93339M8.75 6.93339H6.04626M8.75 6.93339V4.1937"
                                                        stroke="#DC2626" stroke-width="1.7354" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>30%</span>
                                    </div>
                                    <h6 class="text-xs font-normal text-gray-500">New Application</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KIRI BAWAH: Lamaran Terbaru -->
                <div class="rounded-xl p-0.5 border border-solid border-gray-200 overflow-auto">
                    <div class="flex flex-col min-[440px]:flex-row max-[440px]:gap-3 items-center justify-between p-4">
                        <h5 class="text-base font-semibold text-gray-900">
                            Lamaran Terbaru
                        </h5>
                        <form>
                            <div class="relative text-gray-500 focus-within:text-gray-900">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="stroke-current ml-1" xmlns="http://www.w3.org/2000/svg" width="14"
                                        height="14" viewBox="0 0 14 14" fill="none">
                                        <path
                                            d="M12.25 12.25L10.7917 10.7917M11.0833 6.41667C11.0833 3.83934 8.994 1.75 6.41667 1.75C3.83934 1.75 1.75 3.83934 1.75 6.41667C1.75 8.994 3.83934 11.0833 6.41667 11.0833C7.70036 11.0833 8.86299 10.565 9.7067 9.72627C10.557 8.88101 11.0833 7.71031 11.0833 6.41667Z"
                                            stroke="#111827" stroke-linecap="round"></path>
                                    </svg>
                                </div>
                                <input type="text" id="default-search"
                                    class="block w-full max-w-52 pr-2.5 pl-8 py-2 text-xs font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none"
                                    placeholder="Search here">
                            </div>
                        </form>
                    </div>
                    <table class="w-full rounded-xl">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col"
                                    class="py-3.5 pl-4 text-left whitespace-nowrap text-xs font-medium text-gray-900 capitalize">
                                    Nama
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 text-left whitespace-nowrap text-xs font-medium text-gray-900 capitalize">
                                    Email
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 text-left whitespace-nowrap text-xs font-medium text-gray-900 capitalize">
                                    Posisi
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 text-left whitespace-nowrap text-xs font-medium text-gray-900 capitalize">
                                    Tanggal Melamar
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 text-left whitespace-nowrap text-xs font-medium text-gray-900 capitalize">
                                    Status
                                </th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                <td class="pxy-3.5 pl-4 py-3 font-medium text-xs text-gray-800">
                                    Floyd Miles
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    floydmiles@pagedone.io
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Design
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Jun. 24, 2023
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                    <span
                                        class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-0.5">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-500 flex"></span>Apply
                                    </span>
                                </td>
                            </tr>
                            <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Jane Cooper
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    jane.cooper@example.com
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Research
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Feb. 23, 2023
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                    <span
                                        class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-0.5">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-500 flex"></span>Apply
                                    </span>
                                </td>
                            </tr>
                            <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Jane Cooper
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    jane.cooper@example.com
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Development
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Oct. 23, 2023
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                    <span
                                        class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-0.5">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-500 flex"></span>Apply
                                    </span>
                                </td>
                            </tr>
                            <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Jane Cooper
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    jane.cooper@example.com
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    AI &amp; ML
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Jul. 12, 2023
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                    <span
                                        class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-0.5">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-500 flex"></span>Apply
                                    </span>
                                </td>
                            </tr>
                            <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Jane Cooper
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    jane.cooper@example.com
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Design
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Sep. 29, 2023
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                    <span
                                        class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-0.5">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-500 flex"></span>Apply
                                    </span>
                                </td>
                            </tr>
                            <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Jane Cooper
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    jane.cooper@example.com
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Design
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Dec. 02, 2023
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                    <span
                                        class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-0.5">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-500 flex"></span>Apply
                                    </span>
                                </td>
                            </tr>
                            <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Jane Cooper
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    jane.cooper@example.com
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Design
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-xs font-normal text-gray-800">
                                    Dec. 02, 2023
                                </td>
                                <td class="py-3.5 pl-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                    <span
                                        class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium mr-2 pl-2 pr-2.5 rounded-full py-0.5">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-500 flex"></span>Apply
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- BAGIAN KANAN -->
            <div class="col-span-12 xl:col-span-4 flex flex-col gap-6">

                <!-- KANAN ATAS: Upcoming Schedule -->
                <div class="rounded-xl p-4 border border-solid border-gray-200">
                    <div class="flex items-center justify-between pb-4 border-b border-solid border-gray-200">
                        <h5 class="text-base font-semibold text-gray-900">
                            Jadwal Interview
                        </h5>
                        <button
                            class="flex items-center rounded-md border border-solid border-gray-300 py-1.5 pr-1.5 pl-3 gap-1.5 text-xs font-medium text-gray-900 transition-all duration-300 hover:bg-gray-50 hover:border-gray-400">
                            Today
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path
                                    d="M11.3333 3L11.3333 3.5L11.3333 3ZM4.66666 3.00002L4.66666 2.50002L4.66666 3.00002ZM5.36719 9.83333C5.64333 9.83333 5.86719 9.60948 5.86719 9.33333C5.86719 9.05719 5.64333 8.83333 5.36719 8.83333V9.83333ZM5.33385 8.83333C5.05771 8.83333 4.83385 9.05719 4.83385 9.33333C4.83385 9.60948 5.05771 9.83333 5.33385 9.83333V8.83333ZM5.36719 11.8333C5.64333 11.8333 5.86719 11.6095 5.86719 11.3333C5.86719 11.0572 5.64333 10.8333 5.36719 10.8333V11.8333ZM5.33385 10.8333C5.05771 10.8333 4.83385 11.0572 4.83385 11.3333C4.83385 11.6095 5.05771 11.8333 5.33385 11.8333V10.8333ZM8.03385 9.83333C8.31 9.83333 8.53385 9.60948 8.53385 9.33333C8.53385 9.05719 8.31 8.83333 8.03385 8.83333V9.83333ZM8.00052 8.83333C7.72438 8.83333 7.50052 9.05719 7.50052 9.33333C7.50052 9.60948 7.72438 9.83333 8.00052 9.83333V8.83333ZM8.03385 11.8333C8.31 11.8333 8.53385 11.6095 8.53385 11.3333C8.53385 11.0572 8.31 10.8333 8.03385 10.8333V11.8333ZM8.00052 10.8333C7.72438 10.8333 7.50052 11.0572 7.50052 11.3333C7.50052 11.6095 7.72438 11.8333 8.00052 11.8333V10.8333ZM10.7005 9.83333C10.9767 9.83333 11.2005 9.60948 11.2005 9.33333C11.2005 9.05719 10.9767 8.83333 10.7005 8.83333V9.83333ZM10.6672 8.83333C10.391 8.83333 10.1672 9.05719 10.1672 9.33333C10.1672 9.60948 10.391 9.83333 10.6672 9.83333V8.83333ZM10.7005 11.8333C10.9767 11.8333 11.2005 11.6095 11.2005 11.3333C11.2005 11.0572 10.9767 10.8333 10.7005 10.8333V11.8333ZM10.6672 10.8333C10.391 10.8333 10.1672 11.0572 10.1672 11.3333C10.1672 11.6095 10.391 11.8333 10.6672 11.8333V10.8333ZM5.83333 2C5.83333 1.72386 5.60948 1.5 5.33333 1.5C5.05719 1.5 4.83333 1.72386 4.83333 2H5.83333ZM4.83333 4C4.83333 4.27614 5.05719 4.5 5.33333 4.5C5.60948 4.5 5.83333 4.27614 5.83333 4H4.83333ZM11.1667 2C11.1667 1.72386 10.9428 1.5 10.6667 1.5C10.3905 1.5 10.1667 1.72386 10.1667 2H11.1667ZM10.1667 4C10.1667 4.27614 10.3905 4.5 10.6667 4.5C10.9428 4.5 11.1667 4.27614 11.1667 4H10.1667ZM4.66666 3.50002L11.3333 3.5L11.3333 2.5L4.66666 2.50002L4.66666 3.50002ZM13.5 5.66667V11.3334H14.5V5.66667H13.5ZM11.3333 13.5H4.66667V14.5H11.3333V13.5ZM2.5 11.3334V5.66668H1.5V11.3334H2.5ZM4.66667 13.5C4.02399 13.5 3.59229 13.499 3.27026 13.4557C2.96262 13.4143 2.83096 13.3428 2.74408 13.2559L2.03697 13.963C2.34062 14.2667 2.71848 14.3905 3.13701 14.4467C3.54116 14.5011 4.05226 14.5 4.66667 14.5V13.5ZM1.5 11.3334C1.5 11.9478 1.49894 12.4589 1.55327 12.863C1.60954 13.2815 1.73332 13.6594 2.03697 13.963L2.74408 13.2559C2.6572 13.1691 2.58572 13.0374 2.54436 12.7298C2.50106 12.4077 2.5 11.976 2.5 11.3334H1.5ZM13.5 11.3334C13.5 11.976 13.4989 12.4077 13.4556 12.7298C13.4143 13.0374 13.3428 13.1691 13.2559 13.2559L13.963 13.963C14.2667 13.6594 14.3905 13.2815 14.4467 12.863C14.5011 12.4589 14.5 11.9478 14.5 11.3334H13.5ZM11.3333 14.5C11.9477 14.5 12.4588 14.5011 12.863 14.4467C13.2815 14.3905 13.6594 14.2667 13.963 13.963L13.2559 13.2559C13.169 13.3428 13.0374 13.4143 12.7297 13.4557C12.4077 13.499 11.976 13.5 11.3333 13.5V14.5ZM11.3333 3.5C11.976 3.5 12.4077 3.50106 12.7297 3.54436C13.0374 3.58572 13.169 3.6572 13.2559 3.74408L13.963 3.03697C13.6594 2.73333 13.2815 2.60955 12.863 2.55328C12.4588 2.49894 11.9477 2.5 11.3333 2.5L11.3333 3.5ZM14.5 5.66667C14.5 5.05227 14.5011 4.54116 14.4467 4.13702C14.3905 3.71849 14.2667 3.34062 13.963 3.03697L13.2559 3.74408C13.3428 3.83096 13.4143 3.96262 13.4556 4.27026C13.4989 4.59229 13.5 5.024 13.5 5.66667H14.5ZM4.66666 2.50002C4.05226 2.50002 3.54116 2.49896 3.13701 2.55329C2.71848 2.60956 2.34062 2.73334 2.03697 3.03699L2.74408 3.7441C2.83095 3.65722 2.96262 3.58574 3.27026 3.54437C3.59228 3.50108 4.02399 3.50002 4.66666 3.50002L4.66666 2.50002ZM2.5 5.66668C2.5 5.02401 2.50106 4.5923 2.54436 4.27028C2.58572 3.96264 2.6572 3.83097 2.74408 3.7441L2.03697 3.03699C1.73332 3.34064 1.60954 3.7185 1.55327 4.13703C1.49894 4.54118 1.5 5.05228 1.5 5.66668H2.5ZM2 7.16667H14V6.16667H2V7.16667ZM5.36719 8.83333H5.33385V9.83333H5.36719V8.83333ZM5.36719 10.8333H5.33385V11.8333H5.36719V10.8333ZM8.03385 8.83333H8.00052V9.83333H8.03385V8.83333ZM8.03385 10.8333H8.00052V11.8333H8.03385V10.8333ZM10.7005 8.83333H10.6672V9.83333H10.7005V8.83333ZM10.7005 10.8333H10.6672V11.8333H10.7005V10.8333ZM4.83333 2V4H5.83333V2H4.83333ZM10.1667 2V4H11.1667V2H10.1667Z"
                                    fill="#111827"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="pt-4">
                        <div class="flex flex-col gap-4">
                            <!-- Item 1 -->
                            <div class="w-full">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="inline-flex items-center bg-indigo-50 text-indigo-600 text-xs font-medium pl-2 pr-2.5 rounded-full py-1">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-indigo-500 flex"></span>User Interview
                                    </span>
                                    <div class="dropdown relative inline-flex">
                                        <button type="button" data-target="dropdown-1"
                                            class="dropdown-toggle inline-flex justify-center items-center gap-2 p-0.5 text-sm text-white rounded-md cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M12.0161 16.9896V17.0396M12.0161 11.976V12.026M12.0161 6.96228V7.01228"
                                                    stroke="#6B7280" stroke-width="2.5" stroke-linecap="round">
                                                </path>
                                            </svg>
                                        </button>
                                        <div id="dropdown-1"
                                            class="dropdown-menu rounded-xl shadow-lg bg-white absolute right-2 top-full w-44 mt-2 hidden"
                                            aria-labelledby="dropdown-default">
                                            <ul class="py-2">
                                                <li>
                                                    <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium"
                                                        href="#">
                                                        See Profile
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium"
                                                        href="#">
                                                        Reschedule
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-2.5 pl-2.5 border-l-2 border-solid border-indigo-600">
                                    <h6 class="text-base font-semibold text-gray-900 mb-0.5">
                                        UI/UX Designer
                                    </h6>
                                    <p class="text-gray-500 text-xs font-normal mb-2.5">
                                        Wawancara dengan Head of Design
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-1.5">
                                            <p class="text-xs font-medium text-gray-900">
                                                Ethan Miller
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <path
                                                    d="M8 5.99999V8.66666L10 10.6667M2 3.41421L3.40476 2M13.9987 3.41771L12.5939 2.0035M13.3333 8.66666C13.3333 11.6122 10.9455 14 8 14C5.05448 14 2.66667 11.6122 2.66667 8.66666C2.66667 5.72114 5.05448 3.33332 8 3.33332C10.9455 3.33332 13.3333 5.72114 13.3333 8.66666Z"
                                                    stroke="#6B7280" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                            <p class="text-xs font-normal text-gray-500">
                                                09:00 AM - 09:30 AM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Item 2 -->
                            <div class="w-full">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="inline-flex items-center bg-amber-50 text-amber-600 text-xs font-medium pl-2 pr-2.5 rounded-full py-1">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-amber-600 flex"></span>Technical Test
                                    </span>
                                    <div class="dropdown relative inline-flex">
                                        <button type="button" data-target="dropdown-one"
                                            class="dropdown-toggle inline-flex justify-center items-center gap-2 p-0.5 text-sm text-white rounded-md cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M12.0161 16.9896V17.0396M12.0161 11.976V12.026M12.0161 6.96228V7.01228"
                                                    stroke="#6B7280" stroke-width="2.5" stroke-linecap="round">
                                                </path>
                                            </svg>
                                        </button>
                                        <div id="dropdown-one"
                                            class="dropdown-menu rounded-xl shadow-lg bg-white absolute right-2 top-full w-44 mt-2 hidden"
                                            aria-labelledby="dropdown-default">
                                            <ul class="py-2">
                                                <li>
                                                    <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium"
                                                        href="#">
                                                        See Profile
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium"
                                                        href="#">
                                                        Reschedule
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-2.5 pl-2.5 border-l-2 border-solid border-amber-600">
                                    <h6 class="text-base font-semibold text-gray-900 mb-0.5">
                                        Frontend Developer
                                    </h6>
                                    <p class="text-gray-500 text-xs font-normal mb-2.5">
                                        Live Coding Session &amp; Portofolio Review
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-1.5">
                                            <p class="text-xs font-medium text-gray-900">
                                                Emily Johnson
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <path
                                                    d="M8 5.99999V8.66666L10 10.6667M2 3.41421L3.40476 2M13.9987 3.41771L12.5939 2.0035M13.3333 8.66666C13.3333 11.6122 10.9455 14 8 14C5.05448 14 2.66667 11.6122 2.66667 8.66666C2.66667 5.72114 5.05448 3.33332 8 3.33332C10.9455 3.33332 13.3333 5.72114 13.3333 8.66666Z"
                                                    stroke="#6B7280" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                            <p class="text-xs font-normal text-gray-500">
                                                10:30 AM - 12:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Item 3 -->
                            <div class="w-full">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="inline-flex items-center bg-emerald-50 text-emerald-600 text-xs font-medium pl-2 pr-2.5 rounded-full py-1">
                                        <span class="w-1 h-1 mr-1 rounded-full bg-emerald-600 flex"></span>HR Interview
                                    </span>
                                    <div class="dropdown relative inline-flex">
                                        <button type="button" data-target="dropdown-two"
                                            class="dropdown-toggle inline-flex justify-center items-center gap-2 p-0.5 text-sm text-white rounded-md cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M12.0161 16.9896V17.0396M12.0161 11.976V12.026M12.0161 6.96228V7.01228"
                                                    stroke="#6B7280" stroke-width="2.5" stroke-linecap="round">
                                                </path>
                                            </svg>
                                        </button>
                                        <div id="dropdown-two"
                                            class="dropdown-menu rounded-xl shadow-lg bg-white absolute right-2 top-full w-44 mt-2 hidden"
                                            aria-labelledby="dropdown-default">
                                            <ul class="py-2">
                                                <li>
                                                    <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium"
                                                        href="#">
                                                        See Profile
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium"
                                                        href="#">
                                                        Reschedule
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-2.5 pl-2.5 border-l-2 border-solid border-emerald-600">
                                    <h6 class="text-base font-semibold text-gray-900 mb-0.5">
                                        Backend Developer
                                    </h6>
                                    <p class="text-gray-500 text-xs font-normal mb-2.5">
                                        Wawancara dengan Human Resources
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-1.5">
                                            <p class="text-xs font-medium text-gray-900">
                                                Olivia Carter
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <path
                                                    d="M8 5.99999V8.66666L10 10.6667M2 3.41421L3.40476 2M13.9987 3.41771L12.5939 2.0035M13.3333 8.66666C13.3333 11.6122 10.9455 14 8 14C5.05448 14 2.66667 11.6122 2.66667 8.66666C2.66667 5.72114 5.05448 3.33332 8 3.33332C10.9455 3.33332 13.3333 5.72114 13.3333 8.66666Z"
                                                    stroke="#6B7280" stroke-width="1.2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                            <p class="text-xs font-normal text-gray-500">
                                                12:00 PM - 01:00 PM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KANAN BAWAH: Announcement -->
                <div class="rounded-xl p-4 border border-solid border-gray-200">
                    <div class="flex items-center justify-between pb-4 border-b border-solid border-gray-200">
                        <h5 class="text-base font-semibold text-gray-900">
                            Pengumuman
                        </h5>
                        <button
                            class="flex items-center rounded-md border border-solid border-gray-300 py-1.5 p-3 gap-1.5 text-xs font-medium text-gray-900 transition-all duration-300 hover:bg-gray-50 hover:border-gray-400">
                            Lihat Semua
                        </button>
                    </div>
                    <div class="pt-6 flex flex-col gap-6">
                        <div class="flex items-center justify-between gap-3 w-full">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    {{-- <img class="w-10 h-10 rounded-full" src="assets/images/announce-avatar-1.png" alt="Rounded avatar">
                                    <span class="bottom-0 left-7 absolute w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span> --}}
                                </div>
                                <div class="block">
                                    <h6 class="text-xs font-semibold text-gray-900 mb-0.5">
                                        Batas Akhir Seleksi Berkas Backend Developer
                                    </h6>
                                    <p class="text-xs font-normal text-gray-500">
                                        Hari ini, 15:00 WIB
                                    </p>
                                </div>
                            </div>
                            <div class="dropdown relative inline-flex">
                                <button type="button" data-target="dropdown-one1"
                                    class="dropdown-toggle inline-flex justify-center items-center gap-2 p-0.5 text-sm text-white rounded-md cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path d="M12.0161 16.9896V17.0396M12.0161 11.976V12.026M12.0161 6.96228V7.01228"
                                            stroke="#6B7280" stroke-width="2.5" stroke-linecap="round"></path>
                                    </svg>
                                </button>
                                <div id="dropdown-one1"
                                    class="dropdown-menu rounded-xl shadow-lg bg-white absolute right-2 top-full w-44 mt-2 hidden"
                                    aria-labelledby="dropdown-default">
                                    <ul class="py-2">
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium" href="#">
                                                Lihat Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium" href="#">
                                                Tandai Dibaca
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-3 w-full">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    {{-- <img class="w-10 h-10 rounded-full" src="assets/images/announce-avatar-2.png" alt="Rounded avatar">
                                    <span class="bottom-0 left-7 absolute w-3.5 h-3.5 bg-red-500 border-2 border-white rounded-full"></span> --}}
                                </div>
                                <div class="block">
                                    <h6 class="text-xs font-semibold text-gray-900 mb-0.5">
                                        Jadwal Onboarding Karyawan Baru
                                    </h6>
                                    <p class="text-xs font-normal text-gray-500">
                                        Besok, 09:00 WIB
                                    </p>
                                </div>
                            </div>
                            <div class="dropdown relative inline-flex">
                                <button type="button" data-target="dropdown-one2"
                                    class="dropdown-toggle inline-flex justify-center items-center gap-2 p-0.5 text-sm text-white rounded-md cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path d="M12.0161 16.9896V17.0396M12.0161 11.976V12.026M12.0161 6.96228V7.01228"
                                            stroke="#6B7280" stroke-width="2.5" stroke-linecap="round"></path>
                                    </svg>
                                </button>
                                <div id="dropdown-one2"
                                    class="dropdown-menu rounded-xl shadow-lg bg-white absolute right-2 top-full w-44 mt-2 hidden"
                                    aria-labelledby="dropdown-default">
                                    <ul class="py-2">
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium" href="#">
                                                Lihat Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium" href="#">
                                                Tandai Dibaca
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-3 w-full">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    {{-- <img class="w-10 h-10 rounded-full" src="assets/images/announce-avatar-3.png" alt="Rounded avatar">
                                    <span class="bottom-0 left-7 absolute w-3.5 h-3.5 bg-amber-500 border-2 border-white rounded-full"></span> --}}
                                </div>
                                <div class="block">
                                    <h6 class="text-xs font-semibold text-gray-900 mb-0.5">
                                        Dibutuhkan 3 kandidat tambahan untuk Data Analyst
                                    </h6>
                                    <p class="text-xs font-normal text-gray-500">
                                        24 Apr, 08:00 WIB
                                    </p>
                                </div>
                            </div>
                            <div class="dropdown relative inline-flex">
                                <button type="button" data-target="dropdown-one3"
                                    class="dropdown-toggle inline-flex justify-center items-center gap-2 p-0.5 text-sm text-white rounded-md cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path d="M12.0161 16.9896V17.0396M12.0161 11.976V12.026M12.0161 6.96228V7.01228"
                                            stroke="#6B7280" stroke-width="2.5" stroke-linecap="round"></path>
                                    </svg>
                                </button>
                                <div id="dropdown-one3"
                                    class="dropdown-menu rounded-xl shadow-lg bg-white absolute right-2 top-full w-44 mt-2 hidden"
                                    aria-labelledby="dropdown-default">
                                    <ul class="py-2">
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium" href="#">
                                                Lihat Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium" href="#">
                                                Tandai Dibaca
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-3 w-full">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    {{-- <img class="w-10 h-10 rounded-full" src="assets/images/announce-avatar-4.png" alt="Rounded avatar"> --}}
                                </div>
                                <div class="block">
                                    <h6 class="text-xs font-semibold text-gray-900 mb-0.5">
                                        Pembaruan sistem penilaian kandidat <br>
                                        pada dashboard perusahaan
                                    </h6>
                                </div>
                            </div>
                            <div class="dropdown relative inline-flex">
                                <button type="button" data-target="dropdown-one4"
                                    class="dropdown-toggle inline-flex justify-center items-center gap-2 p-0.5 text-sm text-white rounded-md cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path d="M12.0161 16.9896V17.0396M12.0161 11.976V12.026M12.0161 6.96228V7.01228"
                                            stroke="#6B7280" stroke-width="2.5" stroke-linecap="round"></path>
                                    </svg>
                                </button>
                                <div id="dropdown-one4"
                                    class="dropdown-menu rounded-xl shadow-lg bg-white absolute right-2 top-full w-44 mt-2 hidden"
                                    aria-labelledby="dropdown-default">
                                    <ul class="py-2">
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium" href="#">
                                                Lihat Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-medium" href="#">
                                                Tandai Dibaca
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

    </div>
@endsection