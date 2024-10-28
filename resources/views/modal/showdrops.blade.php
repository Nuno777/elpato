<div class="modal fade" id="showdrop" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalForm">If you want to add all the drops to the Telegram bot, this will help you. <br>
                    Click<a href="https://t.me/elpatomessagebot" target="_blank"> here</a> to go directly to the Bot.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <i class="mdi mdi-telegram"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ implode(',', $drops->pluck('id_drop')->toArray()) }}</p>
            </div>
        </div>
    </div>
</div>
