<div id="questionFormWrapper" @class([
    'hidden' => $isModal,
    'question__wrapper_modal' => $isModal,
    'bg-white p-6 rounded-lg shadow-md w-full' => true,
])>

    <form @class([
        'question__form_modal w-full sm:w-[30rem] px-8 py-6' => $isModal,
        'space-y-6' => true,
    ]) id="questionForm" method="POST">


        <div class="flex justify-between text-white mb-4">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Оставьте заявку</h3>

            @if ($isModal)
                <button id="questionUnvisible" class="text-xl cursor-pointer" type="button"><i
                        class="fa fa-close"></i></button>
            @endif
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-gray-700 mb-2 font-medium">Ваше имя *</label>
                <input name="name" type="text" id="name"
                    class="w-full border rounded-md px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Иван Иванов" required>
            </div>

            <div>
                <label for="company_name" class="block text-gray-700 mb-2 font-medium">Компания</label>
                <input name="company_name" type="text" id="company_name"
                    class="w-full border rounded-md px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Название вашей компании">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="phone" class="block text-gray-700 mb-2 font-medium">Телефон *</label>
                <input name='phone' type="tel" id="phone"
                    class="w-full border rounded-md px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="+7 (XXX) XXX-XX-XX" required>
            </div>

            <div>
                <label for="email" class="block text-gray-700 mb-2 font-medium">Email</label>
                <input name="email" type="email" id="email"
                    class="w-full border rounded-md px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="example@mail.ru">
            </div>
        </div>

        <div>
            <label for="comment" class="block text-gray-700 mb-2 font-medium">Сообщение</label>
            <textarea name="comment" id="comment" rows="5"
                class="w-full border rounded-md px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Опишите ваш вопрос или заказ..."></textarea>
        </div>

        <div class="flex items-center">
            <input name="policy" type="checkbox" id="agree"
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
            <label for="agree" class="ml-2 text-gray-700 text-sm">
                Я согласен на обработку персональных данных в соответствии с
                <a href="/policy.php" class="text-blue-600 hover:text-blue-800">Политикой
                    конфиденциальности</a>
            </label>
        </div>

        <button type="submit"
            class="cursor-pointer bg-blue-600 text-white px-8 py-4 rounded-md hover:bg-blue-700 transition-colors w-full font-medium text-lg">
            Отправить сообщение
        </button>
    </form>
</div>
