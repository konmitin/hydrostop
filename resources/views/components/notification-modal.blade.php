<style>
    .notification-modal__wrapper {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        max-width: 24rem;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-bottom: 1.5rem;
        transform: translate(0, 2rem);
        transition: all .3s;
        visibility: hidden;
        opacity: 0;
    }

    .notification-modal__content {
        padding: 1rem;
        z-index: 1000;
        border: .15rem solid;
        background: var(--color-white);
        color: var(--color-gray-900);
    }

    .notification-modal__content.success {
        border-color: var(--color-green-600);
    }

    .notification-modal__content.success i {
        color: var(--color-green-600);
    }

    .notification-modal__content.error {
        border-color: var(--color-red-700);
    }

    .notification-modal__content.error i {
        color: var(--color-red-500);
    }

    .notification-modal__content.info {
        border-color: var(--color-gray-500);
    }

    .notification-modal__content.info i {
        color: var(--color-gray-500);
    }

    .notification-modal__wrapper.active {
        transform: translate(0, 0);
        visibility: visible;
        opacity: 1;
    }
</style>

<div id="notificationWrapper" class="notification-modal__wrapper z-40">
    <div id="notificationContent"
        class="flex gap-4 sm:block notification-modal__content text-white rounded-md overflow-hidden w-full info">
        <i id="notificationIcon" class="fa fa-info-circle"></i> <span id="notificationContentText"></span>
    </div>
</div>
