<script setup>
import Layout from './Layout/Layout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import { toast } from 'vue3-toastify';


const props = defineProps({
  employees: Array,
  departments: Array
});

const showForm = ref(false);
const currentEmployee = ref(null); 

const form = useForm({
  name: null,
  email: null,
  phone_number: null,
  department_id: null
});

const submitForm = () => {
  if (currentEmployee.value) {
    form.put(route('employees.update', currentEmployee.value.id), form.value, {
      onSuccess: () => {
        form.reset();
        showForm.value = false;
        currentEmployee.value = null; 
      },
      onError: (errors) => {
        console.error('Form submission error', errors);
      }
    });
  } else {
    form.post(route('employees.store'), form.value, {
      onSuccess: () => {
        form.reset();
        showForm.value = false;
      },
      onError: (errors) => {
        console.error('Form submission error', errors);
      }
    });
  }
};

const editEmployee = (employee) => {
  form.name = employee.name;
  form.email = employee.email;
  form.phone_number = employee.phone_number;
  form.department_id = employee.department_id;
  currentEmployee.value = employee; 
  showForm.value = true; 
};

const deleteEmployee = (id) => {
  if (confirm('Are you sure you want to delete this employee?')) {
    form.delete(route('employees.destroy', id), {
      onSuccess: () => {
        toast.success('Successfully Deleted!')
      },
      onError: (errors) => {
        console.errors('Delete error', errors);
      }
    })
  }
}

const toggleForm = () => {
  showForm.value = !showForm.value;
  if (!showForm.value) {
    form.reset(); 
    currentEmployee.value = null;
  }
};


</script>

<template>
  <Layout>
    <Head title="Employees" />
    <div class="bg-white p-6 shadow-md rounded-md border-b">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Employees</h2>
        <button @click="toggleForm" 
          class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">
          {{ showForm ? 'Cancel' : 'Add Employee' }}
        </button>
      </div>

      <div v-if="showForm" class="mb-6">
        <form @submit.prevent="submitForm" class="space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" v-model="form.name" type="text" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="John Cena" />
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" v-model="form.email" type="email" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="email" />
          </div>

          <div>
            <label for="phone_number" class="block text-sm font-medium text-gray-700">phone_number Number</label>
            <input id="phone_number" v-model="form.phone_number" type="tel" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
          </div>

          <div>
            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
            <select id="department" v-model="form.department_id" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
              <option disabled value="">Select a Department</option>
              <option v-for="department in departments" :key="department.id" :value="department.id">
                {{ department.name }}
              </option>
            </select>
          </div>

          <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              {{ currentEmployee ? 'Update Employee' : 'Save Employee' }}
            </button>
          </div>
        </form>
      </div>

      <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Name</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Email</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">phone_number</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Department</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="employee in employees" :key="employee.id" class="bg-white hover:bg-gray-50">
            <td class="py-3 px-4 border-b">{{ employee.name }}</td>
            <td class="py-3 px-4 border-b">{{ employee.email }}</td>
            <td class="py-3 px-4 border-b">{{ employee.phone_number }}</td>
            <td class="py-3 px-4 border-b">{{ employee.department.name }}</td>
            <td class="py-3 px-4 border-b flex space-x-2">
              <button @click="editEmployee(employee)"
                class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">
                Edit
              </button>
              <button @click="deleteEmployee(employee.id)"
                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Layout>
</template>
