<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
  email: "",
  subject: "",
  body: "",
});

const submit = () => {
  let endpoint = route("email.store");
  let payload = form;

  fetch(endpoint, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(payload),
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data.message);
    })
    .catch((error) => {
      console.error("Error sending email:", error);
      alert("Failed to send email");
    });

  form.reset();
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="pt-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">You're logged in!</div>
        </div>
      </div>
    </div>
    <div class="pt-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <form class="p-6 text-gray-900" @submit.prevent="submit">
            <div>
              <InputLabel for="subject" value="Subject" />

              <TextInput
                id="subject"
                type="text"
                class="mt-1 block w-full"
                v-model="form.subject"
                required
                autofocus
              />
            </div>

            <div class="mt-4">
              <InputLabel for="email" value="Email" />

              <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
              />
            </div>

            <div class="mt-4">
              <InputLabel for="body" value="Body" />

              <TextInput
                id="body"
                type="text"
                class="mt-1 block w-full"
                v-model="form.body"
                required
              />
            </div>

            <div class="flex items-center justify-end mt-4">
              <PrimaryButton
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Send
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
