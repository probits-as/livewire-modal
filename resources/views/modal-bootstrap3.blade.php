<div>
    @isset($jsPath)
        <script>{!! file_get_contents($jsPath) !!}</script>
    @endisset
    @isset($cssPath)
        <style>{!! file_get_contents($cssPath) !!}</style>
    @endisset
    <div x-data="LivewireUIModal()">

        @teleport('body')
        <div
                x-on:close.stop="setShowPropertyTo(false)"
                x-on:keydown.escape.window="show && closeModalOnEscape()"
                x-show="show"
                class="modal fade"
                :class="show ? 'fade in show' : ''"
                id="myModalComponent"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalComponentLabel"
                aria-hidden="true"
                style="display: none;"
        >
            <div class="modal-dialog" role="document">
                <div
                        x-show="show && showActiveComponent"
                        x-bind:class="modalWidth"
                        class="modal-content"
                        id="modal-container"
                        x-trap.noscroll.inert="show && showActiveComponent"
                >
                    @forelse($components as $id => $component)
                        <div
                                x-show.immediate="activeComponent == '{{ $id }}'"
                                x-ref="{{ $id }}"
                                wire:key="{{ $id }}"
                        >
                            @livewire($component['name'], $component['arguments'], key($id))
                        </div>
                    @empty
                        <!-- No components -->
                    @endforelse
                </div>
            </div>
        </div>

        @endteleport

        <div class="modal-backdrop fade in" x-show="show"></div>
    </div>
</div>
