<x-template-mail>

    <div class="email-body">
        <p class="greeting">
            Hi, {{ $client->name }}<br><br>
            Welcome to CAR INSPECTION. Your account has been created.
        </p>

        <div class="credentials-box">
            <div class="credential-item">
                <span class="credential-label">Email</span>
                <div>
                    <span class="credential-value">{{ $client->email }}</span>
                </div>
            </div>
            <div class="credential-item">
                <span class="credential-label">Password</span>
                <div class="password-field">
                    <span class="credential-value">{{ $password }}</span>
                </div>
            </div>
        </div>

        <div style="margin: 20px 0;">
            <a href="https://{{ $_SERVER['SERVER_NAME'] }}/login" class="button"
                style="display: block; text-align: center;">
                Sign In
            </a>
        </div>

        <div class="small-note">
            Keep this email for reference
        </div>
    </div>


</x-template-mail>
