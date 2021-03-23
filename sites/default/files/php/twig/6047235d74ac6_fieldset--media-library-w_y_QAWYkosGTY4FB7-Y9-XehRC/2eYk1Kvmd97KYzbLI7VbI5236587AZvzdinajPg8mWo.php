<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* core/themes/claro/templates/media-library/fieldset--media-library-widget.html.twig */
class __TwigTemplate_5c0981db5d48d6f793fc5f9521b76b3ea17159d493a8d76d2f8483ee292f3e08 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "fieldset.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 20
        $context["attributes"] = $this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => "media-library-widget"], "method");
        // line 23
        $context["prefix"] = $this->getAttribute($this, "media_library_prefix", [0 => ($context["prefix"] ?? null)], "method");
        // line 1
        $this->parent = $this->loadTemplate("fieldset.html.twig", "core/themes/claro/templates/media-library/fieldset--media-library-widget.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 12
    public function getmedia_library_prefix($__prefix__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "prefix" => $__prefix__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 13
            echo "  ";
            if ($this->getAttribute(($context["prefix"] ?? null), "empty_selection", [])) {
                // line 14
                echo "    <p class=\"media-library-widget-empty-text\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null)), "html", null, true);
                echo "</p>
  ";
            } else {
                // line 16
                echo "    ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null)), "html", null, true);
                echo "
  ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "core/themes/claro/templates/media-library/fieldset--media-library-widget.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 16,  60 => 14,  57 => 13,  45 => 12,  40 => 1,  38 => 23,  36 => 20,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/claro/templates/media-library/fieldset--media-library-widget.html.twig", "/app/core/themes/claro/templates/media-library/fieldset--media-library-widget.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 20, "macro" => 12, "if" => 13];
        static $filters = ["escape" => 14];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'macro', 'if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
