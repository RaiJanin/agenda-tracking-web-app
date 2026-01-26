<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda & Meeting Tracking System - Membership Request</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8 text-center relative">
            <div class="absolute top-4 right-4 bg-white text-indigo-600 px-3 py-1 rounded-full text-sm font-medium shadow-md">
                Current Role: Guest
            </div>
            <h1 class="text-4xl font-bold mb-2">Access Company Agendas & Meetings</h1>
            <p class="text-lg opacity-90">Apply for membership to view and track the latest agendas and meeting details for your company.</p>
        </div>

        <!-- Content Section -->
        <div class="p-8">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Benefits List -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Why Apply for Membership?</h2>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Access to the latest company agendas and meeting schedules
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Track meeting progress and outcomes in real-time
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Receive notifications for upcoming meetings and updates
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Collaborate with team members on agenda items
                        </li>
                    </ul>
                </div>

                <!-- Membership Action Form -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Request Membership Access</h2>
                    <form class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your full name" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your work email" required>
                        </div>
                        <div>
                            <label for="company" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input type="text" id="company" name="company" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your company name" required>
                        </div>
                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700">Department (Optional)</label>
                            <input type="text" id="department" name="department" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., IT, HR, Finance">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Reason for Access (Optional)</label>
                            <textarea id="message" name="message" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Briefly explain why you need access to agendas and meetings"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                            Submit Membership Request
                        </button>
                    </form>
                    <p class="text-sm text-gray-500 mt-4">Your request will be reviewed by the system administrator. You'll receive an email confirmation once approved.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 p-4 text-center text-gray-600">
            <p>&copy; 2023 Agenda & Meeting Tracking System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>