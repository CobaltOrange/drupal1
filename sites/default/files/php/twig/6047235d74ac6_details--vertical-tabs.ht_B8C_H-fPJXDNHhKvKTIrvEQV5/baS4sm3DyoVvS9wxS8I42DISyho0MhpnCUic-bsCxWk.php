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

/* core/themes/claro/templates/navigation/details--vertical-tabs.html.twig */
class __TwigTemplate_0997b43e28cca957e658f932972eefe03c11ebef3be5420817584779307f18f3 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 29
        $context["classes"] = [0 => "claro-details", 1 => "claro-details--vertical-tabs-item"];
        // line 35
        $context["content_wrapper_classes"] = [0 => "claro-details__wrapper", 1 => "details-wrapper", 2 => "claro-details__wrapper--vertical-tabs-item"];
        // line 42
        $context["inner_wrapper_classes"] = [0 => "claro-details__content", 1 => "claro-details__content--vertical-tabs-item"];
        // line 47
        echo "<details";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">";
        // line 48
        if (($context["title"] ?? null)) {
            // line 50
            $context["summary_classes"] = [0 => "claro-details__summary", 1 => "claro-details__summary--vertical-tabs-item", 2 => ((            // line 53
($context["required"] ?? null)) ? ("js-form-required") : ("")), 3 => ((            // line 54
($context["required"] ?? null)) ? ("form-required") : (""))];
            // line 57
            echo "    <summary";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["summary_attributes"] ?? null), "addClass", [0 => ($context["summary_classes"] ?? null)], "method")), "html", null, true);
            echo ">";
            // line 58
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            // line 59
            echo "</summary>";
        }
        // line 61
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content_attributes"] ?? null), "addClass", [0 => ($context["content_wrapper_classes"] ?? null)], "method")), "html", null, true);
        echo ">
    <div";
        // line 62
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->createAttribute(["class" => ($context["inner_wrapper_classes"] ?? null)]), "html", null, true);
        echo ">
      ";
        // line 63
        if (($context["errors"] ?? null)) {
            // line 64
            echo "        <div class=\"form-item form-item--error-message\">
          ";
            // line 65
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null)), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 68
        if (($context["description"] ?? null)) {
            // line 69
            echo "<div class=\"claro-details__description\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null)), "html", null, true);
            echo "</div>";
        }
        // line 71
        if (($context["children"] ?? null)) {
            // line 72
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null)), "html", null, true);
        }
        // line 74
        if (($context["value"] ?? null)) {
            // line 75
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["value"] ?? null)), "html", null, true);
        }
        // line 77
        echo "</div>
  </div>
</details>
";
    }

    public function getTemplateName()
    {
        return "core/themes/claro/templates/navigation/details--vertical-tabs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 77,  91 => 75,  89 => 74,  86 => 72,  84 => 71,  79 => 69,  77 => 68,  71 => 65,  68 => 64,  66 => 63,  62 => 62,  57 => 61,  54 => 59,  52 => 58,  48 => 57,  46 => 54,  45 => 53,  44 => 50,  42 => 48,  38 => 47,  36 => 42,  34 => 35,  32 => 29,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/claro/templates/navigation/details--vertical-tabs.html.twig", "/app/core/themes/claro/templates/navigation/details--vertical-tabs.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 29, "if" => 48];
        static $filters = ["escape" => 47];
        static $functions = ["create_attribute" => 62];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                ['create_attribute']
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
