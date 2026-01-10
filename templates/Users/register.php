<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\User $user */
$loginUrl = $this->Url->build(['controller' => 'Users', 'action' => 'login']);
$this->setLayout('auth');
$this->assign('title', __('Criar conta'));

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
                <span class="brand-subtitle"><?= __('Crie seu perfil de campanha') ?></span>
            </div>
        </div>

        <header class="auth-card__header">
            <h1><?= __('Inicie sua aventura') ?></h1>
            <p><?= __('Configure seu perfil em poucos passos.') ?></p>
            <p class="auth-card__hint">
                <?= __('Ja possui conta?') ?>
                <a class="auth-link" href="<?= $loginUrl ?>"><?= __('Entrar') ?></a>
            </p>
        </header>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create($user, [
            'class' => 'auth-form',
            'data-auth-form' => 'register',
            'data-form-error' => __('Finalize os requisitos de senha antes de continuar.'),
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
                <label class="field__label" for="register-username"><?= __('Usuario') ?></label>
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
                <label class="field__label" for="register-password"><?= __('Senha') ?></label>
                <button
                    class="field__action"
                    type="button"
                    data-toggle-password
                    data-target="#register-password"
                    aria-label="<?= __('Mostrar senha') ?>"
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
                data-label-weak="<?= __('Fraca') ?>"
                data-label-medium="<?= __('Media') ?>"
                data-label-strong="<?= __('Forte') ?>"
                data-msg-idle="<?= __('Use uma senha forte para proteger sua conta.') ?>"
                data-msg-too-short="<?= __('Senha muito curta. Use ao menos 5 caracteres.') ?>"
                data-msg-invalid="<?= __('Sua senha precisa cumprir todos os requisitos abaixo.') ?>"
                data-msg-valid="<?= __('Senha forte pronta para uso.') ?>"
            >
                <div class="password-meter__bar">
                    <span class="password-meter__fill" data-strength-fill></span>
                </div>
                <div class="password-meter__labels">
                    <span><?= __('Forca') ?>: <strong data-strength-text><?= __('Fraca') ?></strong></span>
                    <span class="password-meter__count" data-strength-count>0/4</span>
                </div>
                <p class="password-meter__message" data-strength-message><?= __('Use uma senha forte para proteger sua conta.') ?></p>
                <ul class="password-checklist" data-password-checklist>
                    <li data-check="length"><?= __('Minimo de 8 caracteres') ?></li>
                    <li data-check="upper"><?= __('Pelo menos 1 letra maiuscula') ?></li>
                    <li data-check="number"><?= __('Pelo menos 1 numero') ?></li>
                    <li data-check="symbol"><?= __('Pelo menos 1 simbolo') ?></li>
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
                <label class="field__label" for="register-password-confirm"><?= __('Confirmar senha') ?></label>
                <button
                    class="field__action"
                    type="button"
                    data-toggle-password
                    data-target="#register-password-confirm"
                    aria-label="<?= __('Mostrar senha') ?>"
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
                    data-mismatch-text="<?= __('As senhas nao coincidem.') ?>"
                    hidden
                ></p>
            </div>

            <button class="btn btn-primary" type="submit">
                <?= __('Criar conta') ?>
            </button>

            <p class="auth-form__footer">
                <?= __('Ao criar uma conta voce concorda com os termos.') ?>
            </p>
        <?= $this->Form->end() ?>
    </section>

    <?= $this->element('auth_side_panel', [
        'image' => 'register.png',
        'tag' => __('Novo chamado'),
        'title' => __('Monte sua mesa moderna'),
        'subtitle' => __('Crie sua identidade e organize campanhas com visual clean.'),
        'items' => [
            __('Convide sua party em segundos'),
            __('Armazene fichas com seguranca'),
            __('Interface atual com detalhes RPG'),
        ],
        'alt' => __('Register illustration'),
    ]) ?>
</div>

<?php echo $this->Html->script('auth', ['block' => true, 'type' => 'module']); ?>