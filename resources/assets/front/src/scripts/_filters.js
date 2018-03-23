import moment from '@/scripts/_moment'

export function relativeTime (time) {
  return moment(time).fromNow()
}
