<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <div
                v-if="show"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
            >
                <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
                    <div class="mb-4 flex items-center gap-3 text-amber-600 dark:text-amber-400">
                        <Icon name="heroicons:exclamation-triangle" class="h-8 w-8" />
                        <h3 class="text-lg font-semibold">Session Timeout Warning</h3>
                    </div>

                    <p class="mb-4 text-gray-600 dark:text-gray-300">
                        You have been inactive for a while. Your session will expire in
                        <span class="font-mono font-bold text-amber-600 dark:text-amber-400">
                            {{ formattedTimeRemaining }}
                        </span>
                        due to inactivity.
                    </p>

                    <div class="flex gap-3">
                        <Button
                            variant="primary"
                            class="flex-1"
                            @click="$emit('continue')"
                        >
                            Stay Logged In
                        </Button>
                        <Button
                            variant="secondary"
                            class="flex-1"
                            @click="$emit('logout')"
                        >
                            Logout Now
                        </Button>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup lang="ts">
defineProps<{
    show: boolean
    formattedTimeRemaining: string
}>()

defineEmits<{
    continue: []
    logout: []
}>()
</script>
