<?php
/**
 * @var \App\View\AppView $this
 */
$redirect = $this->request->getQuery('redirect');
$currentLang = $this->request->getParam('lang') ?? 'en';
$formUrl = ['action' => 'login', 'lang' => $currentLang];
if ($redirect) {
    $formUrl['?'] = ['redirect' => $redirect];
}
$this->setLayout('auth');
$this->assign('title', __('Log in'));

$emailError = $this->Form->isFieldError('email');
$passwordError = $this->Form->isFieldError('password');
?>
<div class="auth-grid">
    <section class="auth-card" data-animate="card" style="--delay: 0.05s">
        <div class="auth-card__brand">
            <span class="brand-mark" aria-hidden="true"></span>
            <div>
                <span class="brand-name">DiceRPG</span>
                <span class="brand-subtitle"><?= __('Modern RPG companion') ?></span>
            </div>
        </div>

        <header class="auth-card__header">
            <h1><?= __('Welcome back') ?></h1>
            <p><?= __('Log in to continue your journey.') ?></p>
        </header>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create(null, ['url' => $formUrl, 'class' => 'auth-form', 'data-auth-form' => 'login']) ?>
            <?php if ($redirect): ?>
                <?= $this->Form->hidden('redirect', ['value' => $redirect]) ?>
            <?php endif; ?>

            <div class="field<?= $emailError ? ' field--error' : '' ?>">
                <input
                    type="email"
                    id="login-email"
                    name="email"
                    autocomplete="email"
                    required
                    class="field__input"
                    placeholder=" "
                    value="<?= h($this->request->getData('email')) ?>"
                    aria-invalid="<?= $emailError ? 'true' : 'false' ?>"
                >
                <label class="field__label" for="login-email"><?= __('Email') ?></label>
                <?= $this->Form->error('email', null, ['class' => 'field__error']) ?>
            </div>

            <div class="field field--has-action<?= $passwordError ? ' field--error' : '' ?>">
                <input
                    type="password"
                    id="login-password"
                    name="password"
                    autocomplete="current-password"
                    required
                    class="field__input"
                    placeholder=" "
                    data-password-input
                    aria-invalid="<?= $passwordError ? 'true' : 'false' ?>"
                >
                <label class="field__label" for="login-password"><?= __('Password') ?></label>
                <button
                    class="field__action"
                    type="button"
                    data-toggle-password
                    data-target="#login-password"
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

            <div class="auth-form__row">
                <a class="auth-link" href="#"><?= __('Forgot your password?') ?></a>
            </div>

            <button class="btn btn-primary" type="submit">
                <?= __('Log in') ?>
            </button>

            <p class="auth-form__footer">
                <?= __('Don\'t have an account?') ?>
                <a class="auth-link" href="<?= $this->Language->url(['controller' => 'Users', 'action' => 'register']) ?>">
                    <?= __('Create account') ?>
                </a>
            </p>
        <?= $this->Form->end() ?>
    </section>

    <?= $this->element('auth_side_panel', [
        'image' => 'login.png',
        'tag' => __('Access portal'),
        'title' => __('Your guild is ready'),
        'subtitle' => __('Manage campaigns, sheets, and rolls with a modern style.'),
        'items' => [
            __('Campaign dashboard always in sync'),
            __('Notes and maps in one place'),
            __('Light interface with subtle glow'),
        ],
        'alt' => __('Login illustration'),
    ]) ?>
</div>
<?php echo $this->Html->script('auth', ['block' => true, 'type' => 'module']); ?>
