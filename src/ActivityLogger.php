<?php declare(strict_types=1);

use GeneralForm\ITemplatePath;
use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;
use Nette\Neon\Neon;
use Tracy\ILogger;


/**
 * Class ActivityLogger
 *
 * @author  geniv
 */
class ActivityLogger extends Control implements ITemplatePath
{
    /** @var ITranslator */
    private $translator = null;
    /** @var string */
    private $templatePath;
    /** @var string */
    private $path;
    /** @var ILogger */
    private $logger;


    /**
     * ActivityLogger constructor.
     *
     * @param string|null      $path
     * @param ITranslator|null $translator
     * @param ILogger          $logger
     */
    public function __construct(string $path = null, ITranslator $translator = null, ILogger $logger)
    {
        parent::__construct();

        $this->path = $path ?: __DIR__ . '/activity-logger.neon';
        $this->translator = $translator;
        $this->logger = $logger;

        $this->templatePath = __DIR__ . '/ActivityLogger.latte';  // implicit path
    }


    /**
     * Set template path.
     *
     * @param string $path
     */
    public function setTemplatePath(string $path)
    {
        $this->templatePath = $path;
    }


    /**
     * Render.
     *
     * @throws Exception
     */
    public function render()
    {
        $request = $this->presenter->getHttpRequest();
        $url = $request->getUrl()->relativeUrl;

        $file[$url] = [];
        if (file_exists($this->path)) {
            $identity = $this->presenter->user->getIdentity();

            $file = Neon::decode(file_get_contents($this->path));
            $file[$url][$identity->login] = new DateTime();
        }
        file_put_contents($this->path, Neon::encode($file, Neon::BLOCK));

        $template = $this->getTemplate();
        $template->items = $file[$url];

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath);
        $template->render();
    }
}
