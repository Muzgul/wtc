/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_memmove.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/06/07 15:38:19 by mmacdona          #+#    #+#             */
/*   Updated: 2017/10/01 02:08:54 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

void	*ft_memmove(void *dst, const void *src, size_t len)
{
	size_t				i;
	unsigned char		c;
	unsigned char		*pd;
	const unsigned char	*ps;

	pd = (unsigned char*)dst;
	ps = (const unsigned char*)src;
	if (ps < pd)
	{
		i = len - 1;
		len = -1;
	}
	else
		i = 0;
	while (i != len)
	{
		c = *(ps + i);
		if (c != *(pd + i))
			*(pd + i) = c;
		if (ps < pd)
			i--;
		else
			i++;
	}
	return (dst);
}
