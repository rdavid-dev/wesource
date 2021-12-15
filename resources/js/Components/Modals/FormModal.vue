<template>
  <div v-if="show" class="container flex justify-center mx-auto">
    <div
      class="
        absolute
        inset-0
        flex
        items-center
        justify-center
        bg-gray-700 bg-opacity-50
      "
    >
      <div class="min-w-sm max-w-lg p-6 bg-white divide-y divide-gray-500" style="width:400px">
        <div class="flex items-center justify-between">
          <h3 class="text-2xl" v-text="title"></h3>
          <svg
            @click="emitCloseModal"
            xmlns="http://www.w3.org/2000/svg"
            class="w-6 h-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </div>
        <div class="mt-4">
          <slot name="body"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: ['show', 'title'],
        methods: {
            emitCloseModal() {
                this.$emit('closeModal')
            }
        }
    };
</script>