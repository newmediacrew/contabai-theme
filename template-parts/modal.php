<?php
$state = isset($args['state']) ? (string) $args['state'] : 'modalOpen';
$title = isset($args['title']) ? (string) $args['title'] : "''";
$body  = isset($args['body']) ? (string) $args['body'] : '';
?>
<template x-teleport="body">
    <div x-show="<?php echo $state; ?>" x-cloak class="relative z-[70]">
        <div x-show="<?php echo $state; ?>" x-transition.opacity x-on:click="<?php echo $state; ?> = false" class="fixed inset-0 bg-neutral-900/50"></div>
        <div class="fixed inset-0 flex items-center justify-center p-3 sm:p-6" x-on:click.self="<?php echo $state; ?> = false">
            <div x-show="<?php echo $state; ?>"
                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 role="dialog" aria-modal="true"
                 class="flex max-h-[85vh] w-full max-w-2xl flex-col rounded-2xl bg-white shadow-xl">
                <div class="flex items-center justify-between border-b border-neutral-200 px-5 py-4">
                    <h2 class="contabai-heading text-lg text-[color:var(--heading-color,#111827)]" x-text="<?php echo $title; ?>"></h2>
                    <button type="button" x-on:click="<?php echo $state; ?> = false" aria-label="<?php esc_attr_e('Close', 'contabai-theme'); ?>" class="rounded-md p-1.5 text-neutral-500 transition hover:bg-neutral-100"><?php echo \ContabaiTheme\Heroicon::outline('x-mark', 'w-5 h-5'); ?></button>
                </div>
                <div class="no-scrollbar overflow-y-auto px-6 py-6"><?php echo $body; ?></div>
            </div>
        </div>
    </div>
</template>
