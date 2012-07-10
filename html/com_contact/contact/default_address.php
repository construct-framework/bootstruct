<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

if (($this->params->get('address_check') > 0) && ($this->contact->address || $this->contact->suburb || $this->contact->state || $this->contact->country || $this->contact->postcode)) :
    ?><section class="contact-address adr">
            <dl>
                <dt class="<?php echo $this->params->get('marker_class'); ?>">
                    <?php echo $this->params->get('marker_address'); ?>
                </dt>
                <dd>
                    <?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
                    <span class="contact-street street-address">
                            <?php echo nl2br($this->contact->address); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
                    <span class="contact-suburb locality">
                            <?php echo $this->contact->suburb; ?>
                        </span>
                    <?php endif; ?>
                    <?php if ($this->contact->state && $this->params->get('show_state')) : ?>
                    <span class="contact-state region">
                            <?php echo $this->contact->state; ?>
                        </span>
                    <?php endif; ?>
                    <?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
                    <span class="contact-postcode postal-code">
                            <?php echo $this->contact->postcode; ?>
                        </span>
                    <?php endif; ?>
                    <?php if ($this->contact->country && $this->params->get('show_country')) : ?>
                    <span class="contact-country country-name">
                            <?php echo $this->contact->country; ?>
                        </span>
                    <?php endif; ?>
                </dd>
            </dl>
        </section>
    <?php endif; ?>

<?php if ($this->params->get('show_email') || $this->params->get('show_telephone') || $this->params->get('show_fax') || $this->params->get('show_mobile') || $this->params->get('show_webpage')) : ?>
        <section class="contact-contactinfo">
            <dl>
    <?php endif; ?>
<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
    <dt class="<?php echo $this->params->get('marker_class'); ?>">
        <?php echo $this->params->get('marker_email'); ?>
    </dt>
    <dd class="contact-emailto email">
        <?php echo $this->contact->email_to; ?>
    </dd>
    <?php endif; ?>
<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
    <dt class="<?php echo $this->params->get('marker_class'); ?>">
        <?php echo $this->params->get('marker_telephone'); ?>
    </dt>
    <dd class="contact-telephone tel">
        <?php echo nl2br($this->contact->telephone); ?>
    </dd>
    <?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
    <dt class="<?php echo $this->params->get('marker_class'); ?>">
        <?php echo $this->params->get('marker_fax'); ?>
    </dt>
    <dd class="contact-fax tel">
        <?php echo nl2br($this->contact->fax); ?>
    </dd>
    <?php endif; ?>
<?php if ($this->contact->mobile && $this->params->get('show_mobile')) : ?>
    <dt class="<?php echo $this->params->get('marker_class'); ?>">
        <?php echo $this->params->get('marker_mobile'); ?>
    </dt>
    <dd class="contact-mobile tel">
        <?php echo nl2br($this->contact->mobile); ?>
    </dd>
    <?php endif; ?>
<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
    <dt class="<?php echo $this->params->get('marker_class'); ?>"></dt>
    <dd class="contact-webpage">
        <a href="<?php echo $this->contact->webpage; ?>" target="_blank">
            <?php echo $this->contact->webpage; ?></a>
    </dd>
    <?php endif; ?>
<?php if ($this->params->get('show_email') || $this->params->get('show_telephone') || $this->params->get('show_fax') || $this->params->get('show_mobile') || $this->params->get('show_webpage')) : ?>
            </dl>
        </section>
    <?php endif;

