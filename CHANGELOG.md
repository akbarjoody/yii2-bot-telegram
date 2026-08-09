# Changelog

## Unreleased — Bot API 10.2 alignment

### Added
- PHPDoc coverage for Bot API methods through **10.2** (rich messages, ephemeral messages, live photos, guest mode, managed bots, gifts/Stars, forum topics, business, etc.)
- Update types on `Input`: channel/business/guest messages, reactions, boosts, subscriptions, managed bots, and more
- New types: `LivePhoto`, `Community`, `ReplyParameters`, `InputMediaLivePhoto`, `InputMediaVoiceNote`
- Message / Result / User / Poll / Chat / keyboard fields for recent API versions
- Working SOCKS/HTTP `proxy` support in Guzzle client

### Fixed
- `mediaInputHelper`: local files now upload with `attach://` references (sendMediaGroup / editMessageMedia)
- `Command::run`: null-safe when there is no message/text; strips `@BotUsername` from commands
- `Input::edited_message` (and other message-like updates) hydrated as `Message`
- `ChatPermissions` / `ChatMember` / `ChatPhoto` extend `Type` so unknown API fields do not throw
- JSON encoding of nested params (`reply_markup`, etc.) and safer API error JSON handling
- composer author email typo; pinned Yii2 / Guzzle version constraints

### Notes
- Any Bot API method can still be called dynamically via `$telegram->methodName($params)` even if a dedicated type class is not present yet.
- Official API reference: https://core.telegram.org/bots/api
- Changelog: https://core.telegram.org/bots/api-changelog
