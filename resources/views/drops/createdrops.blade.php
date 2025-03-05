{{-- <div class="modal fade" id="createDropModal" tabindex="-1" role="dialog" aria-labelledby="createDropModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDropModalLabel">Create Drop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('createdrops.store') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="id_drop">Drop</label>
                                <input type="text" name="id_drop" id="id_drop" class="form-control"
                                    placeholder="Drop" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Name" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Address" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="packages">Packages</label>
                                        <input type="text" name="packages" id="packages" class="form-control"
                                            placeholder="Packages" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" class="form-control" id="type">
                                            <option value="All">All</option>
                                            <option value="Salaried">Salaried</option>
                                            <option value="Nonsalaried">Nonsalaried</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected value="Default"
                                                style="background-color: #fff; color: black; " disabled>
                                                Default</option>
                                            <option value="Ready" style="background-color: #82FB6A; color: black; ">
                                                Ready</option>
                                            <option value="Problem" style="background-color: #FF7059; color: white;">
                                                Problem</option>
                                            <option value="Dont send" style="background-color: #F1DD50; color: black;">
                                                Dont send</option>
                                            <option option value="Suspense"
                                                style="background-color: #424945; color: white;">Suspense
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expired">Expired At</label>
                                        <input type="date" name="expired" id="expired" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea style="resize: none;" type="text" name="notes" id="notes" class="form-control" placeholder="Notes"
                                    cols="43" rows="5" required>N/A</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="personalnotes">Personal Notes</label>
                                <textarea style="resize: none;" type="text" name="personalnotes" id="personalnotes" class="form-control"
                                    placeholder="Personal Notes" cols="43" rows="5" required>N/A</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Insert Drop</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div x-show="createdrop" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999">
    <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
    <div @click.outside="createdrop = false"
        class="relative w-full max-w-[584px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
        <!-- close btn -->
        <button @click="createdrop = false"
            class="group absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-200 text-gray-500 transition-colors hover:bg-gray-300 hover:text-gray-500 dark:bg-gray-800 dark:hover:bg-gray-700 sm:right-6 sm:top-6 sm:h-11 sm:w-11">
            <svg class="transition-colors fill-current group-hover:text-gray-600 dark:group-hover:text-gray-200"
                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                    fill />
            </svg>
        </button>

        <form method="POST" action="{{ route('createdrops.store') }}">
            {{ csrf_field() }}

            <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                Create Drop
            </h4>

            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">
                <div class="col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Drop
                    </label>
                    <input type="text" name="id_drop" id="id_drop" placeholder="Drop" required
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                </div>

                <div class="col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Name
                    </label>
                    <input type="text" name="name" id="name" placeholder="Name" required
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                </div>

                <div class="col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Address
                    </label>
                    <input type="text" name="address" id="address" placeholder="Address" required
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                </div>

                <div class="col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Packages
                    </label>
                    <input type="text" name="packages" id="packages" placeholder="Packages" required
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                </div>

                <div class="col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Type
                    </label>
                    <select name="type" id="type"
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                        <option value="All">All</option>
                        <option value="Salaried">Salaried</option>
                        <option value="Nonsalaried">Nonsalaried</option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <select name="status" id="status" required
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                        <option selected value="Default" style="background-color: #fff; color: black; " disabled>
                            Default</option>
                        <option value="Ready" style="background-color: #82FB6A; color: black; ">
                            Ready</option>
                        <option value="Problem" style="background-color: #FF7059; color: white;">
                            Problem</option>
                        <option value="Dont send" style="background-color: #F1DD50; color: black;">
                            Dont send</option>
                        <option option value="Suspense" style="background-color: #424945; color: white;">Suspense
                        </option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Expired At
                    </label>
                    <div class="relative">
                        <input type="date" name="expired" id="expired" required placeholder="Select date"
                            class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            onclick="this.showPicker()" />
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                    fill />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Notes
                    </label>
                    <textarea style="resize: none;" type="text" name="notes" id="notes" cols="43" rows="5" required
                        placeholder="Enter your notes" rows="6"
                        class="dark:bg-dark-900 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">N/A</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end w-full gap-3 mt-6">
                <button type="button"
                    class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto">
                    Close
                </button>
                <button type="submit"
                    class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                    Insert Drop
                </button>
            </div>
        </form>

    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/colortabledrops.js') }}"></script>
@endpush
