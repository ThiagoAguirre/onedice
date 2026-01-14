<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\User $user */
$loginUrl = $this->Language->url(['controller' => 'Users', 'action' => 'login']);
$this->setLayout('auth');
$this->assign('title', __('Create account'));

$usernameError = $this->Form->isFieldError('username');
$emailError = $this->Form->isFieldError('email');
$passwordError = $this->Form->isFieldError('password');
$confirmError = $this->Form->isFieldError('password_confirm');
?>
<div class="auth-grid">
    <section class="auth-card" data-animate="card" style="--delay: 0.05s">
        <div class="auth-card__brand">
            <span class="brand-mark" aria-hidden="true"></span>
            <div>
                <span class="brand-name">DiceRPG</span>
                <span class="brand-subtitle"><?= __('Create your campaign profile') ?></span>
            </div>
        </div>

        <header class="auth-card__header">
            <h1><?= __('Start your adventure') ?></h1>
            <p><?= __('Set up your profile in a few steps.') ?></p>
            <p class="auth-card__hint">
                <?= __('Already have an account?') ?>
                <a class="auth-link" href="<?= $loginUrl ?>"><?= __('Log in') ?></a>
            </p>
        </header>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create($user, [
            'class' => 'auth-form',
            'data-auth-form' => 'register',
            'data-form-error' => __('Complete the password requirements before continuing.'),
        ]) ?>
            <div class="auth-form__alert" data-form-alert role="alert" hidden></div>

            <div class="field<?= $usernameError ? ' field--error' : '' ?>">
                <input
                    id="register-username"
                    name="username"
                    type="text"
                    autocomplete="username"
                    required
                    class="field__input"
                    placeholder=" "
                    value="<?= h($user->username ?? '') ?>"
                    aria-invalid="<?= $usernameError ? 'true' : 'false' ?>"
                >
                <label class="field__label" for="register-username"><?= __('Username') ?></label>
                <?= $this->Form->error('username', null, ['class' => 'field__error']) ?>
            </div>

            <div class="field<?= $emailError ? ' field--error' : '' ?>">
                <input
                    id="register-email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    class="field__input"
                    placeholder=" "
                    value="<?= h($user->email ?? '') ?>"
                    aria-invalid="<?= $emailError ? 'true' : 'false' ?>"
                >
                <label class="field__label" for="register-email"><?= __('Email') ?></label>
                <?= $this->Form->error('email', null, ['class' => 'field__error']) ?>
            </div>

            <div class="field field--has-action<?= $passwordError ? ' field--error' : '' ?>">
                <input
                    id="register-password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="field__input"
                    placeholder=" "
                    data-password-input
                    aria-invalid="<?= $passwordError ? 'true' : 'false' ?>"
                >
                <label class="field__label" for="register-password"><?= __('Password') ?></label>
                <button
                    class="field__action"
                    type="button"
                    data-toggle-password
                    data-target="#register-password"
                    aria-label="<?= __('Show password') ?>"
                    aria-pressed="false"
                >
                    <svg class="field__eye" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                        <path class="field__eye-slash" d="M4 4l16 16"></path>
                    </svg>
                </button>
                <?= $this->Form->error('password', null, ['class' => 'field__error']) ?>
            </div>

            <div
                class="password-meter"
                data-password-meter
                data-min-length="8"
                data-short-threshold="5"
                data-label-weak="<?= __('Weak') ?>"
                data-label-medium="<?= __('Medium') ?>"
                data-label-strong="<?= __('Strong') ?>"
                data-msg-idle="<?= __('Use a strong password to protect your account.') ?>"
                data-msg-too-short="<?= __('Password too short. Use at least 5 characters.') ?>"
                data-msg-invalid="<?= __('Your password must meet all requirements below.') ?>"
                data-msg-valid="<?= __('Strong password ready to use.') ?>"
            >
                <div class="password-meter__bar">
                    <span class="password-meter__fill" data-strength-fill></span>
                </div>
                <div class="password-meter__labels">
                    <span><?= __('Strength') ?>: <strong data-strength-text><?= __('Weak') ?></strong></span>
                    <span class="password-meter__count" data-strength-count>0/4</span>
                </div>
                <p class="password-meter__message" data-strength-message><?= __('Use a strong password to protect your account.') ?></p>
                <ul class="password-checklist" data-password-checklist>
                    <li data-check="length"><?= __('Minimum of 8 characters') ?></li>
                    <li data-check="upper"><?= __('At least 1 uppercase letter') ?></li>
                    <li data-check="number"><?= __('At least 1 number') ?></li>
                    <li data-check="symbol"><?= __('At least 1 symbol') ?></li>
                </ul>
            </div>

            <div class="field field--has-action<?= $confirmError ? ' field--error' : '' ?>">
                <input
                    id="register-password-confirm"
                    name="password_confirm"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="field__input"
                    placeholder=" "
                    data-confirm-input
                    aria-invalid="<?= $confirmError ? 'true' : 'false' ?>"
                >
                <label class="field__label" for="register-password-confirm"><?= __('Confirm password') ?></label>
                <button
                    class="field__action"
                    type="button"
                    data-toggle-password
                    data-target="#register-password-confirm"
                    aria-label="<?= __('Show password') ?>"
                    aria-pressed="false"
                >
                    <svg class="field__eye" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                        <path class="field__eye-slash" d="M4 4l16 16"></path>
                    </svg>
                </button>
                <?= $this->Form->error('password_confirm', null, ['class' => 'field__error']) ?>
                <p
                    class="field__message"
                    data-confirm-message
                    data-mismatch-text="<?= __('Passwords do not match.') ?>"
                    hidden
                ></p>
            </div>

            <button class="btn btn-primary" type="submit">
                <?= __('Create account') ?>
            </button>

            <p class="auth-form__footer">
                <?= __('By creating an account you agree to the terms.') ?>
            </p>
        <?= $this->Form->end() ?>
    </section>

    <?= $this->element('auth_side_panel', [
        'image' => 'register.png',
        'tag' => __('New calling'),
        'title' => __('Build your modern table'),
        'subtitle' => __('Create your identity and organize campaigns with a clean look.'),
        'items' => [
            __('Invite your party in seconds'),
            __('Store sheets securely'),
            __('Modern interface with RPG details'),
        ],
        'alt' => __('Register illustration'),
    ]) ?>
</div>

<?php echo $this->Html->script('auth', ['block' => true, 'type' => 'module']); ?>
