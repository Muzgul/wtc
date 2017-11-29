/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strtrim.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/05/24 13:53:20 by mmacdona          #+#    #+#             */
/*   Updated: 2017/07/25 15:38:22 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strtrim(char *s)
{
	size_t	i;
	char	*str;

	if (s == NULL)
		return (NULL);
	while (ft_isspace(*s) == 1)
		s++;
	i = ft_strlen(s);
	if (i == 0 || *s == '\0')
		return (ft_strnew(0));
	while (ft_isspace(s[i - 1]) == 1)
		i--;
	str = ft_strnew(i);
	if (str == NULL)
		return (NULL);
	ft_strncpy(str, s, i);
	return (str);
}
