<?php
/**
 * Created by PhpStorm.
 * User: Vitaly Belikov vitalij.bell@gmail.com
 * Date: 18.09.2017
 * Time: 1:31
 */

namespace AppBundle\Pagerfanta;

use Pagerfanta\View\Template\DefaultTemplate as BaseDefaultTemplate;

/**
 * DefaultView
 */
class DefaultTemplate extends BaseDefaultTemplate
{
    static protected $defaultOptions = array(
        'previous_message'   => 'Previous',
        'next_message'       => 'Next',
        'css_disabled_class' => 'disabled',
        'css_dots_class'     => 'dots',
        'css_current_class'  => 'active',
        'dots_text'          => '...',
        'container_template' => '<nav><ul class="pagination">%pages%</ul></nav>',
        'page_template'      => '<li class="page-item"><a class="page-link" href="%href%"%rel%>%text%</a></li>',
        'span_template'      => '<li class="page-item %class%"><a class="page-link" href="%href%"%rel%><span class="%class%">%text%</span></a></li>',
        'rel_previous'        => 'prev',
        'rel_next'            => 'next'
    );
}