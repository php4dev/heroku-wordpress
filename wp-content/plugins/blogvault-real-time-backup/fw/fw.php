<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVFW')) :
	
require_once dirname( __FILE__ ) . '/config.php';
require_once dirname( __FILE__ ) . '/request.php';
require_once dirname( __FILE__ ) . './../ipstore.php';

class BVFW {
	public $request;
	public $config;
	public $bvmain;
	public $ipstore;
	public $category;
	public $logger;
	#all rule id will also come under this
		
	const SQLIREGEX = '/(?:[^\\w<]|\\/\\*\\![0-9]*|^)(?:
			@@HOSTNAME|
			ALTER|ANALYZE|ASENSITIVE|
			BEFORE|BENCHMARK|BETWEEN|BIGINT|BINARY|BLOB|
			CALL|CASE|CHANGE|CHAR|CHARACTER|CHAR_LENGTH|COLLATE|COLUMN|CONCAT|CONDITION|CONSTRAINT|CONTINUE|CONVERT|CREATE|CROSS|CURRENT_DATE|CURRENT_TIME|CURRENT_TIMESTAMP|CURRENT_USER|CURSOR|
DATABASE|DATABASES|DAY_HOUR|DAY_MICROSECOND|DAY_MINUTE|DAY_SECOND|DECIMAL|DECLARE|DEFAULT|DELAYED|DELETE|DESCRIBE|DETERMINISTIC|DISTINCT|DISTINCTROW|DOUBLE|DROP|DUAL|DUMPFILE|
EACH|ELSE|ELSEIF|ELT|ENCLOSED|ESCAPED|EXISTS|EXIT|EXPLAIN|EXTRACTVALUE|
FETCH|FLOAT|FLOAT4|FLOAT8|FORCE|FOREIGN|FROM|FULLTEXT|
GRANT|GROUP|HAVING|HEX|HIGH_PRIORITY|HOUR_MICROSECOND|HOUR_MINUTE|HOUR_SECOND|
IFNULL|IGNORE|INDEX|INFILE|INNER|INOUT|INSENSITIVE|INSERT|INTERVAL|ISNULL|ITERATE|
JOIN|KILL|LEADING|LEAVE|LIMIT|LINEAR|LINES|LOAD|LOAD_FILE|LOCALTIME|LOCALTIMESTAMP|LOCK|LONG|LONGBLOB|LONGTEXT|LOOP|LOW_PRIORITY|
MASTER_SSL_VERIFY_SERVER_CERT|MATCH|MAXVALUE|MEDIUMBLOB|MEDIUMINT|MEDIUMTEXT|MID|MIDDLEINT|MINUTE_MICROSECOND|MINUTE_SECOND|MODIFIES|
NATURAL|NO_WRITE_TO_BINLOG|NULL|NUMERIC|OPTION|ORD|ORDER|OUTER|OUTFILE|
PRECISION|PRIMARY|PRIVILEGES|PROCEDURE|PROCESSLIST|PURGE|
RANGE|READ_WRITE|REGEXP|RELEASE|REPEAT|REQUIRE|RESIGNAL|RESTRICT|RETURN|REVOKE|RLIKE|ROLLBACK|
SCHEMA|SCHEMAS|SECOND_MICROSECOND|SELECT|SENSITIVE|SEPARATOR|SHOW|SIGNAL|SLEEP|SMALLINT|SPATIAL|SPECIFIC|SQLEXCEPTION|SQLSTATE|SQLWARNING|SQL_BIG_RESULT|SQL_CALC_FOUND_ROWS|SQL_SMALL_RESULT|STARTING|STRAIGHT_JOIN|SUBSTR|
TABLE|TERMINATED|TINYBLOB|TINYINT|TINYTEXT|TRAILING|TRANSACTION|TRIGGER|
UNDO|UNHEX|UNION|UNLOCK|UNSIGNED|UPDATE|UPDATEXML|USAGE|USING|UTC_DATE|UTC_TIME|UTC_TIMESTAMP|
VALUES|VARBINARY|VARCHAR|VARCHARACTER|VARYING|WHEN|WHERE|WHILE|WRITE|YEAR_MONTH|ZEROFILL)(?=[^\\w]|$)/ix';
		const XSSREGEX = '/(?:
			#tags
			(?:\\<|\\+ADw\\-|\\xC2\\xBC)(script|iframe|svg|object|embed|applet|link|style|meta|\\/\\/|\\?xml\\-stylesheet)(?:[^\\w]|\\xC2\\xBE)|
			#protocols
			(?:^|[^\\w])(?:(?:\\s*(?:&\\#(?:x0*6a|0*106)|j)\\s*(?:&\\#(?:x0*61|0*97)|a)\\s*(?:&\\#(?:x0*76|0*118)|v)\\s*(?:&\\#(?:x0*61|0*97)|a)|\\s*(?:&\\#(?:x0*76|0*118)|v)\\s*(?:&\\#(?:x0*62|0*98)|b)|\\s*(?:&\\#(?:x0*65|0*101)|e)\\s*(?:&\\#(?:x0*63|0*99)|c)\\s*(?:&\\#(?:x0*6d|0*109)|m)\\s*(?:&\\#(?:x0*61|0*97)|a)|\\s*(?:&\\#(?:x0*6c|0*108)|l)\\s*(?:&\\#(?:x0*69|0*105)|i)\\s*(?:&\\#(?:x0*76|0*118)|v)\\s*(?:&\\#(?:x0*65|0*101)|e))\\s*(?:&\\#(?:x0*73|0*115)|s)\\s*(?:&\\#(?:x0*63|0*99)|c)\\s*(?:&\\#(?:x0*72|0*114)|r)\\s*(?:&\\#(?:x0*69|0*105)|i)\\s*(?:&\\#(?:x0*70|0*112)|p)\\s*(?:&\\#(?:x0*74|0*116)|t)|\\s*(?:&\\#(?:x0*6d|0*109)|m)\\s*(?:&\\#(?:x0*68|0*104)|h)\\s*(?:&\\#(?:x0*74|0*116)|t)\\s*(?:&\\#(?:x0*6d|0*109)|m)\\s*(?:&\\#(?:x0*6c|0*108)|l)|\\s*(?:&\\#(?:x0*6d|0*109)|m)\\s*(?:&\\#(?:x0*6f|0*111)|o)\\s*(?:&\\#(?:x0*63|0*99)|c)\\s*(?:&\\#(?:x0*68|0*104)|h)\\s*(?:&\\#(?:x0*61|0*97)|a)|\\s*(?:&\\#(?:x0*64|0*100)|d)\\s*(?:&\\#(?:x0*61|0*97)|a)\\s*(?:&\\#(?:x0*74|0*116)|t)\\s*(?:&\\#(?:x0*61|0*97)|a)(?!(?:&\\#(?:x0*3a|0*58)|\\:)(?:&\\#(?:x0*69|0*105)|i)(?:&\\#(?:x0*6d|0*109)|m)(?:&\\#(?:x0*61|0*97)|a)(?:&\\#(?:x0*67|0*103)|g)(?:&\\#(?:x0*65|0*101)|e)(?:&\\#(?:x0*2f|0*47)|\\/)(?:(?:&\\#(?:x0*70|0*112)|p)(?:&\\#(?:x0*6e|0*110)|n)(?:&\\#(?:x0*67|0*103)|g)|(?:&\\#(?:x0*62|0*98)|b)(?:&\\#(?:x0*6d|0*109)|m)(?:&\\#(?:x0*70|0*112)|p)|(?:&\\#(?:x0*67|0*103)|g)(?:&\\#(?:x0*69|0*105)|i)(?:&\\#(?:x0*66|0*102)|f)|(?:&\\#(?:x0*70|0*112)|p)?(?:&\\#(?:x0*6a|0*106)|j)(?:&\\#(?:x0*70|0*112)|p)(?:&\\#(?:x0*65|0*101)|e)(?:&\\#(?:x0*67|0*103)|g)|(?:&\\#(?:x0*74|0*116)|t)(?:&\\#(?:x0*69|0*105)|i)(?:&\\#(?:x0*66|0*102)|f)(?:&\\#(?:x0*66|0*102)|f)|(?:&\\#(?:x0*73|0*115)|s)(?:&\\#(?:x0*76|0*118)|v)(?:&\\#(?:x0*67|0*103)|g)(?:&\\#(?:x0*2b|0*43)|\\+)(?:&\\#(?:x0*78|0*120)|x)(?:&\\#(?:x0*6d|0*109)|m)(?:&\\#(?:x0*6c|0*108)|l))(?:(?:&\\#(?:x0*3b|0*59)|;)(?:&\\#(?:x0*63|0*99)|c)(?:&\\#(?:x0*68|0*104)|h)(?:&\\#(?:x0*61|0*97)|a)(?:&\\#(?:x0*72|0*114)|r)(?:&\\#(?:x0*73|0*115)|s)(?:&\\#(?:x0*65|0*101)|e)(?:&\\#(?:x0*74|0*116)|t)(?:&\\#(?:x0*3d|0*61)|=)[\\-a-z0-9]+)?(?:(?:&\\#(?:x0*3b|0*59)|;)(?:&\\#(?:x0*62|0*98)|b)(?:&\\#(?:x0*61|0*97)|a)(?:&\\#(?:x0*73|0*115)|s)(?:&\\#(?:x0*65|0*101)|e)(?:&\\#(?:x0*36|0*54)|6)(?:&\\#(?:x0*34|0*52)|4))?(?:&\\#(?:x0*2c|0*44)|,)))\\s*(?:&\\#(?:x0*3a|0*58)|&colon|\\:)|
			#css expression
			(?:^|[^\\w])(?:(?:\\\\0*65|\\\\0*45|e)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*78|\\\\0*58|x)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*70|\\\\0*50|p)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*72|\\\\0*52|r)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*65|\\\\0*45|e)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*73|\\\\0*53|s)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*73|\\\\0*53|s)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*69|\\\\0*49|i)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6f|\\\\0*4f|o)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6e|\\\\0*4e|n))[^\\w]*?(?:\\\\0*28|\\()|
			#css properties
			(?:^|[^\\w])(?:(?:(?:\\\\0*62|\\\\0*42|b)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*65|\\\\0*45|e)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*68|\\\\0*48|h)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*61|\\\\0*41|a)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*76|\\\\0*56|v)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*69|\\\\0*49|i)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6f|\\\\0*4f|o)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*72|\\\\0*52|r)(?:\\/\\*.*?\\*\\/)*)|(?:(?:\\\\0*2d|\\\\0*2d|-)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6d|\\\\0*4d|m)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6f|\\\\0*4f|o)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*7a|\\\\0*5a|z)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*2d|\\\\0*2d|-)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*62|\\\\0*42|b)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*69|\\\\0*49|i)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6e|\\\\0*4e|n)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*64|\\\\0*44|d)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*69|\\\\0*49|i)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6e|\\\\0*4e|n)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*67|\\\\0*47|g)(?:\\/\\*.*?\\*\\/)*))[^\\w]*(?:\\\\0*3a|\\\\0*3a|:)[^\\w]*(?:\\\\0*75|\\\\0*55|u)(?:\\\\0*72|\\\\0*52|r)(?:\\\\0*6c|\\\\0*4c|l)|
			#properties
			(?:^|[^\\w])(?:on(?:abort|activate|afterprint|afterupdate|autocomplete|autocompleteerror|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cancel|canplay|canplaythrough|cellchange|change|click|close|contextmenu|controlselect|copy|cuechange|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|durationchange|emptied|encrypted|ended|error|errorupdate|filterchange|finish|focus|focusin|focusout|formchange|forminput|hashchange|help|input|invalid|keydown|keypress|keyup|languagechange|layoutcomplete|load|loadeddata|loadedmetadata|loadstart|losecapture|message|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|mozfullscreenchange|mozfullscreenerror|mozpointerlockchange|mozpointerlockerror|offline|online|page|pagehide|pageshow|paste|pause|play|playing|popstate|progress|propertychange|ratechange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|search|seeked|seeking|select|selectstart|show|stalled|start|storage|submit|suspend|timer|timeupdate|toggle|unload|volumechange|waiting|webkitfullscreenchange|webkitfullscreenerror|wheel)|formaction|data\\-bind|ev:event)[^\\w]
			)/ix';
	
	public function __construct($bvmain, $ip) {
		$this->bvmain = $bvmain;
		$this->config = new BVFWConfig($this->bvmain);
		$this->request = new BVRequest($ip);
		$this->ipstore = new BVIPStore($bvmain);
		$this->logger = new BVLogger($this->bvmain->db, BVFWConfig::$requests_table);
	}

	public function init() {
		if ($this->isActive()) {
			$this->execute();
		}
		add_action('clear_fw_config', array($this->config, 'clear'));
	}

	public function initLogger() {
		add_filter('status_header', array($this->request, 'captureRespCode'));
		add_action('admin_init', array($this, 'log'));
		add_action('template_redirect', array($this, 'log'));
	}

	public function log() {
		if (!function_exists('is_user_logged_in') || !is_user_logged_in()) {
			$this->logger->log($this->request->getDataToLog());
		}
	}

	public function isActive() {
		return ($this->config->getMode() !== BVFWConfig::DISABLED);
	}
	
	public function isProtecting() {
		return ($this->config->getMode() === BVFWConfig::PROTECT);
	}

	public function terminateRequest($category = null) {
		if ($category)
			$this->request->setCategory($category);
		$this->request->setStatus(BVRequest::BLOCKED);
		$this->request->setRespCode(403);
		if ($this->isProtecting()) {
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Pragma: no-cache");
			header("Expires: 0");
			header('HTTP/1.0 403 Forbidden');
			$this->log();
			$brandname = $this->bvmain->getBrandName();
			die("
				<div style='height: 98vh;'>
					<div style='text-align: center; padding: 10% 0; font-family: Arial, Helvetica, sans-serif;'>
					<div><p><img src=".plugins_url('../img/icon.png', __FILE__)."><h2>Firewall</h2><h3>powered by</h3><h2>"
							.$brandname."</h2></p><div>
						<p>Blocked because of Malicious Activities</p>
					</div>
				</div>
			");
			exit;
		}
	}

	public function isBlacklistedIP() {
		return $this->ipstore->checkIPPresent($this->request->getIP(), BVIPStore::BLACKLISTED, BVIPStore::FW);
	}

	public function isWhitelistedIP() {
		return $this->ipstore->checkIPPresent($this->request->getIP(), BVIPStore::WHITELISTED, BVIPStore::FW);
	}

	public function canBypassFirewall() {
		if ($this->isWhitelistedIP()) {
			$this->request->setCategory(BVRequest::WHITELISTED);
			$this->request->setStatus(BVRequest::BYPASSED);
			return true;
		}
		return false;
	}
	
	public function execute() {
		$this->initLogger();
		if ($this->isBlacklistedIP()) {
			$this->terminateRequest(BVRequest::BLACKLISTED);
		} else if (!$this->canBypassFirewall()) {
			$this->evaluateRules();
		}
	}

	public function getServerValue($key) {
		if (isset($_SERVER) && array_key_exists($key, $_SERVER)) {
			return $_SERVER[$key];
		}
		return null;
	}

	public function match($pattern, $subject) {
		if (is_array($subject)) {
			foreach ($subject as $val) {
				return $this->match($pattern, $val);
			}
			return false;
		} else {
			return preg_match((string) $pattern, (string) $subject, $matches) > 0;
		}
	}

	public function matchMD5($str, $val) {
		return md5((string) $str) === $val;
	}

	public function getLength($val) {
		return strlen(is_array($val) ? join('', $val) : (string) $val);
	}

	public function contains($pattern, $subject) {
		if (is_array($pattern)) {
			return in_array($pattern, $subject, true);
		}
		return strpos((string) $subject, (string) $pattern) !== false;
	}

	public function equals($value, $subject) {
		return $value == $subject;
	}

	public function notEquals($value, $subject) {
		return $value != $subject;
	}

	public function evaluateRules() {
		if ($this->config->getRulesMode() == BVFWConfig::DISABLED)
			return false;

		$request = $this->request;
		$disabledRules = $this->config->getDisabledRules();
		if (!in_array(108, $disabledRules, true)) {
				if ($this->match(BVFW::XSSREGEX, $request->getQueryString()))
					$this->terminateRequest(108);
		}
		if (!in_array(112, $disabledRules, true)) {
				if ($this->match('/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/', $request->getPath()) &&
						(($this->equals('revslider_show_image', $request->getQueryString('action')) && $this->match('/\\.php$/i', $request->getQueryString('img'))) or
						($this->equals('revslider_show_image', $request->getBody('action')) && $this->match('/\\.php$/i', $request->getQueryString('img')))))
					$this->terminateRequest(112);
		}
		if (!in_array(114, $disabledRules, true)) {
				if ($this->match('/<\\!(?:DOCTYPE|ENTITY)\\s+(?:%\\s*)?\\w+\\s+SYSTEM/i', $request->getBody()) or
						$this->match('/<\\!(?:DOCTYPE|ENTITY)\\s+(?:%\\s*)?\\w+\\s+SYSTEM/i', $request->getQueryString()))
					$this->terminateRequest(114);
		}
		if (!in_array(115, $disabledRules, true)) {
				if ($this->match('#/wp\\-admin/admin\\-ajax\\.php$#i', $this->getServerValue('script_filename')) && ($this->equals('update-plugin', $request->getBody('action')) or
						$this->equals('update-plugin', $request->getQueryString('action'))) && ($this->match('/(^|\\/|\\\\|%2f|%5c)\\.\\.(\\\\|\\/|%2f|%5c)/i', $request->getBody()) or
						($this->match('/(^|\\/|\\\\|%2f|%5c)\\.\\.(\\\\|\\/|%2f|%5c)/i', $request->getQueryString()))))
					$this->terminateRequest(115);
		}
		if (!in_array(132, $disabledRules, true)) {
				if (($this->equals('Y', $request->getBody('kentopvc_hidden'))) &&
						((!$this->match('/^1?$/', $request->getBody('kento_pvc_hide'))) or
						(!$this->match('/^1?$/', $request->getBody('kento_pvc_uniq'))) or
						(!$this->match('/^1?$/', $request->getBody('kento_pvc_posttype'))) or
						($this->match(BVFW::XSSREGEX, $request->getBody('kento_pvc_today_text'))) or
						($this->match(BVFW::XSSREGEX, $request->getBody('kento_pvc_total_text'))) or
						($this->match(BVFW::XSSREGEX, $request->getBody('kento_pvc_numbers_lang')))))
					$this->terminateRequest(132);
		}
		if (!in_array(133, $disabledRules, true)) {
				if ((($this->match('#/wp\\-mobile\\-detector[/]+resize\\.php#i', $request->getPath())) or
						($this->match('#/wp\\-mobile\\-detector[/]+timthumb\\.php#i', $request->getPath()))) &&
						((($this->getLength($request->getBody('src')) > 0) &&
						(!$this->match('/\\.(?:png|gif|jpg|jpeg|jif|jfif|svg)$/i', $request->getBody('src')))) or
						(($this->getLength($request->getQueryString('src'))) &&
						(!$this->match('/\\.(?:png|gif|jpg|jpeg|jif|jfif|svg)$/i', $request->getQueryString('src'))))))
					$this->terminateRequest(133);
		}
		if (!in_array(145, $disabledRules, true)) {
				if ((($this->match('/Abonti|aggregator|AhrefsBot|asterias|BDCbot|BLEXBot|BuiltBotTough|Bullseye|BunnySlippers|ca\\-crawler|CCBot|Cegbfeieh|CheeseBot|CherryPicker|CopyRightCheck|cosmos|Crescent|discobot|DittoSpyder|DotBot|Download Ninja|EasouSpider|EmailCollector|EmailSiphon|EmailWolf|EroCrawler|Exabot|ExtractorPro|Fasterfox|FeedBooster|Foobot|Genieo|grub\\-client|Harvest|hloader|httplib|HTTrack|humanlinks|ieautodiscovery|InfoNaviRobot|IstellaBot|Java\\/1\\.|JennyBot|k2spider|Kenjin Spider|Keyword Density\\/0\\.9|larbin|LexiBot|libWeb|libwww|LinkextractorPro|linko|LinkScan\\/8\\.1a Unix|LinkWalker|LNSpiderguy|lwp\\-trivial|magpie|Mata Hari|MaxPointCrawler|MegaIndex|Microsoft URL Control|MIIxpc|Mippin|Missigua Locator|Mister PiX|MJ12bot|moget|MSIECrawler|NetAnts|NICErsPRO|Niki\\-Bot|NPBot|Nutch|Offline Explorer|Openfind|panscient\\.com|PHP\\/5\\.\\{|ProPowerBot\\/2\\.14|ProWebWalker|Python\\-urllib|QueryN Metasearch|RepoMonkey|RMA|SemrushBot|SeznamBot|SISTRIX|sitecheck\\.Internetseer\\.com|SiteSnagger|SnapPreviewBot|Sogou|SpankBot|spanner|spbot|Spinn3r|suzuran|Szukacz\\/1\\.4|Teleport|Telesoft|The Intraformant|TheNomad|TightTwatBot|Titan|toCrawl\\/UrlDispatcher|True_Robot|turingos|TurnitinBot|UbiCrawler|UnisterBot|URLy Warning|VCI|WBSearchBot|Web Downloader\\/6\\.9|Web Image Collector|WebAuto|WebBandit|WebCopier|WebEnhancer|WebmasterWorldForumBot|WebReaper|WebSauger|Website Quester|Webster Pro|WebStripper|WebZip|Wotbox|wsr\\-agent|WWW\\-Collector\\-E|Xenu|Zao|Zeus|ZyBORG|coccoc|Incutio|lmspider|memoryBot|SemrushBot|serf|Unknown|uptime files/i', $request->getHeader('User-Agent'))) &&
						($this->match(BVFW::XSSREGEX, $request->getHeader('User-Agent')))) or
						(($this->match('/semalt\\.com|kambasoft\\.com|savetubevideo\\.com|buttons\\-for\\-website\\.com|sharebutton\\.net|soundfrost\\.org|srecorder\\.com|softomix\\.com|softomix\\.net|myprintscreen\\.com|joinandplay\\.me|fbfreegifts\\.com|openmediasoft\\.com|zazagames\\.org|extener\\.org|openfrost\\.com|openfrost\\.net|googlsucks\\.com|best\\-seo\\-offer\\.com|buttons\\-for\\-your\\-website\\.com|www\\.Get\\-Free\\-Traffic\\-Now\\.com|best\\-seo\\-solution\\.com|buy\\-cheap\\-online\\.info|site3\\.free\\-share\\-buttons\\.com|webmaster\\-traffic\\.co/i', $request->getHeader('Referer'))) &&
						($this->match(BVFW::XSSREGEX, $request->getHeader('User-Agent')))))
					$this->terminateRequest(145);
		}
		if (!in_array(146, $disabledRules, true)) {
				if ($this->match('/sitemap_.*?<.*?(:?_\\d+)?\\.xml(:?\\.gz)?/i', $request->getPath()))
					$this->terminateRequest(146);
		}
		if (!in_array(155, $disabledRules, true)) {
				if (($this->match(BVFW::XSSREGEX, $request->getHeader('Client-IP'))) or
						($this->match(BVFW::XSSREGEX, $request->getHeader('X-Forwarded'))) or
						($this->match(BVFW::XSSREGEX, $request->getHeader('X-Cluster-Client-IP'))) or
						($this->match(BVFW::XSSREGEX, $request->getHeader('Forwarded-For'))) or
						($this->match(BVFW::XSSREGEX, $request->getHeader('Forwarded'))))
					$this->terminateRequest(155);
		}
		if (!in_array(156, $disabledRules, true)) {
				if ($this->match('#/wp\\-admin/admin\\-ajax\\.php$#i', $this->getServerValue('script_filename')) or
						(($this->match(BVFW::SQLIREGEX, $request->getBody('umm_user'))) or
						($this->match(BVFW::SQLIREGEX, $request->getQueryString('umm_user')))))
					$this->terminateRequest(156);
		}
		if (!in_array(165, $disabledRules, true)) {
				if ($this->match('/O:\\d+:"(?!stdClass")[^"]+":/', $request->getCookies('ecwid_oauth_state')))
					$this->terminateRequest(165);
		}
		if (!in_array(167, $disabledRules, true)) {
				if ((!$this->match('/\\.(jpe?g|png|mpeg|mov|flv|pdf|docx?|txt|csv|avi|mp3|wma|wav)($|\\.)/i', $request->getFileNames())) &&
						($this->getLength($request->getBody('save_bepro_listing')) > 0))
					$this->terminateRequest(167);
		}
		if (!in_array(168, $disabledRules, true)) {
				if (($this->match('#/wp\\-admin/admin\\-ajax\\.php$#i', $this->getServerValue('script_filename'))) &&
						($this->equals('master-slider', $request->getQueryString('page'))) &&
						($this->getLength($request->getBody('page')) > 0) &&
						($this->notEquals('master-slider', $request->getBody('page'))))
					$this->terminateRequest(168);
		}
		if (!in_array(169, $disabledRules, true)) {
				if (($this->equals('fancybox-for-wordpress', $request->getQueryString('page'))) &&
						($this->match(BVFW::XSSREGEX, $request->getBody('mfbfw'))))
					$this->terminateRequest(169);
		}
		if (!in_array(171, $disabledRules, true)) {
				if ((($this->match('#wp-json/wp/v\\d+/posts/#i', $request->getPath())) or
						($this->match('#/wp/v\\d+/posts/#i', $request->getQueryString('rest_route')))) &&
						($this->match('/[^0-9]/', $request->getQueryString('id'))))
					$this->terminateRequest(171);
		}
	}
}
endif;